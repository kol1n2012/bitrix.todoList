<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

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

$APPLICATION->ShowViewContent('content_helper_modals');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");