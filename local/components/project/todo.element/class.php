<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
use Bitrix\Main\Data\Cache;
use Bitrix\Main\LoaderException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\SystemException;
use JetBrains\PhpStorm\ArrayShape;

class TodoElement extends CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable
{
    private static int $HL_ID = 1;

    /**
     * TodoElement constructor.
     *
     * @param $component
     * @throws LoaderException
     */
    public function __construct($component = null)
    {
        Loader::includeModule('highloadblock');
        CJSCore::Init();

        parent::__construct($component);
    }

    /**
     * @return array[][]
     */
    #[ArrayShape(['save' => "array[]", 'remove' => "array[]"])] public function configureActions(): array
    {
        return [
            'save' => [
                'prefilters' => [],
                'postfilters' => []
            ],
            'remove' => [
                'prefilters' => [],
                'postfilters' => []
            ]
        ];
    }

    /**
     * @param $params
     * @return array
     */
    public function onPrepareComponentParams($params): array
    {
        $params['CACHE_TYPE'] = (string)@$params['CACHE_TYPE'] ?? 'A';
        $params['CACHE_TIME'] = (int)@$params['CACHE_TIME'] ?? 0;
        $params['ID'] = (int)@$params['ID'] ?? 0;
        $params['HL_ID'] = (int)@$params['HL_ID'] ?? self::$HL_ID;

        return parent::onPrepareComponentParams($params);
    }

    /**
     * @return mixed
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function executeComponent(): mixed
    {
        $cache = Cache::createInstance(); // получаем экземпляр класса

        $cacheTime = $this->arParams['CACHE_TIME'];

        $cacheId = 'todo_list_data_' . $this->GetTemplateName() . '_' . $this->arParams['HL_ID'] . '_' . $this->arParams['ID'];

        if ($cache->initCache($cacheTime, $cacheId)) { // проверяем кеш и задаём настройки

            $this->arResult = json_decode($cache->getVars(), true); // достаем переменные из кеша

        } elseif ($cache->startDataCache()) {

            $this->prepareResult();

            $cache->endDataCache(json_encode($this->arResult, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK)); // записываем в кеш
        }

        $this->includeComponentTemplate();

        return $this->arResult;
    }

    /**
     * Set todoList element data
     *
     * @return void
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function prepareResult(): void
    {
        $entity_data_class = self::getEntityClass();

        $collection = $entity_data_class::getList(
            array(
                'select' => ['*'],
                'filter' => [
                    'ID' => $this->arParams['ID'] ?? 0,
                ],
                'limit' => 1,
                'cache' => [
                    'ttl' => 36000000,
                    'cache_joins' => true,
                ]
            )
        );

        $this->arResult['ELEMENT'] = $collection->fetch();
    }

    /**
     * @return DataManager|string|void
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    private static function getEntityClass()
    {
        $hlId = self::$HL_ID;

        if (!$hlId) return;

        $hlblock = HLBT::getById($hlId)->fetch();

        if (!$hlblock) return;

        $entity = HLBT::compileEntity($hlblock);

        if (!$entity) return;

        return $entity->getDataClass();
    }

    /**
     * @return mixed
     */
    public function getElement(): mixed
    {
        return $this->arResult['ELEMENT'];
    }

    /**
     * Обновление/Добавление записи
     *
     * @param $data
     * @return int
     * @throws Exception
     */
    public function saveAction($data): int
    {
        parse_str($data, $result);

        if (!count($result)) return 0;

        $entity_data_class = self::getEntityClass();

        if ((int)$result['ID']) {
            $id = (int)$result['ID'];
            unset($result['ID']);
            $entity_data_class::update($id, $result);
        } else {
            $entity_data_class::add($result);
        }

        return 1;
    }

    /**
     * Удаление записи
     *
     * @param $id
     * @return int
     * @throws Exception
     */
    public function removeAction($id): int
    {
        if (!$id) return 0;

        $entity_data_class = self::getEntityClass();

        if ((int)$id) {
            $entity_data_class::delete((int)$id);
        } else return 0;

        return 1;
    }
}