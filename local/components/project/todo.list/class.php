<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
use Bitrix\Main\Data\Cache;

class TodoList extends CBitrixComponent
{
    /**
     * TodoList constructor.
     *
     * @param $component
     */
    public function __construct($component = null)
    {
        Loader::includeModule('highloadblock');
		CJSCore::Init(['jquery']);

        parent::__construct($component);
    }

    /**
     * @param $params
     *
     * @return array
     */
    public function onPrepareComponentParams($params): array
    {
        $params['CACHE_TYPE'] = (string)$params['CACHE_TYPE'] ?? 'A';
        $params['CACHE_TIME'] = (int)$params['CACHE_TIME'] ?? 0;
        $params['HL_ID'] = (int)$params['HL_ID'] ?? 0;
		//$params['LIMIT'] = (int)$params['LIMIT'] ?? 0;

        return parent::onPrepareComponentParams($params);
    }
    public function executeComponent()
    {
        $cache = Cache::createInstance(); // получаем экземпляр класса

        $cacheTime = $this->arParams['CACHE_TIME'];

        $cacheId = 'todo_list_data_'.$this->GetTemplateName().'_'.$this->arParams['HL_ID'];

        if ($cache->initCache($cacheTime, $cacheId)) { // проверяем кеш и задаём настройки

            $this->arResult = json_decode($cache->getVars(), true); // достаем переменные из кеша
        }
        elseif ($cache->startDataCache()) {

            $this->prepareResult();

            $cache->endDataCache(json_encode($this->arResult, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK)); // записываем в кеш
        }

        $this->includeComponentTemplate();

        return $this->arResult;
    }

    /**
     * Set todoList data
     */
    public function prepareResult(): void
    {
        $hlId = $this->arParams['HL_ID'];

        if(!$hlId) return;

        $hlblock = HLBT::getById($hlId)->fetch();

        if(!$hlblock) return;

        $entity = HLBT::compileEntity($hlblock);

        if(!$entity) return;

        $entity_data_class = $entity->getDataClass();

        if(!$entity_data_class) return;

        $collection = $entity_data_class::getList(
            array(
                "select" => ['*'],
               // "offset" => 0,
				// "limit" => $this->arParams['LIMIT'],
                'cache' => [
                    'ttl' => 36000000,
                    'cache_joins' => true,
                ]
            )
        );

       $this->arResult['COLLECTION'] = $collection->fetchAll();
    }

    public function getCollection()
    {
        return $this->arResult['COLLECTION'];
    }
}