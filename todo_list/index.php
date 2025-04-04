<?
use \Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$instance = Asset::getInstance();

//отвяжемся от темы. используем скрипты не зависимо от шаблона сайта
$instance->addCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css');
$instance->addCss('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
$instance->addJs('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', true);

$APPLICATION->SetTitle("TODO лист");

echo '<p>Тестовый TODO лист.</p>';

$APPLICATION->IncludeComponent(
        'project:todo.list',
        '',
        [
            'HL_ID' => 1,
        ],
        false,
        ['HIDE_ICONS' => 'Y']
    );

$APPLICATION->IncludeComponent(
        'project:todo.element',
        '',
        [
            'HL_ID' => 1,
        ],
        false,
        ['HIDE_ICONS' => 'Y']
    );

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");