<?
use \Bitrix\Main\Context;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$request = Context::getCurrent()->getRequest();

$APPLICATION->IncludeComponent(
        'project:todo.element',
        '',
        [
            'HL_ID' => 1, 
            'ID' => $request->get("ID"),
        ],
        false,
        ['HIDE_ICONS' => 'Y']
    );