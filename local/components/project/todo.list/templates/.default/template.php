<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
/**
 * @var TodoList $component
 * @var Bitrix\Main\ORM\Entity $arResult
 * @var array $arParams
 */

$collection = $component->getCollection();
?>
<? if (count($collection)): ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Наименование</th>
            <th scope="col">Описание</th>
            <th scope="col">Теги</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($collection as $_k => $element): ?>
            <tr>
                <th scope="row"><?= ++$_k ?></th>
                <td><a href="#" class="todo-element-edit-js" data-id="<?= $element['ID'] ?>" data-bs-toggle="modal" data-bs-target="#todoElementModal"><?= $element['UF_TITLE'] ?></a></td>
                <td><?= $element['UF_DESCRIPTION'] ?></td>
                <td style="max-width: 150px;">
                    <? foreach ($element['UF_TAGS'] as $tag): ?>
                        <span class="badge text-bg-info"><?= $tag ?></span>
                    <? endforeach ?>
                </td>
                <td>
                    <a href="#" class="todo-element-remove-js" data-id="<?= $element['ID'] ?>" data-mdb-tooltip-init=""
                       aria-label="Remove" data-mdb-original-title="Remove" data-mdb-tooltip-initialized="true">
                        <i class="fas fa-trash-alt fa-lg text-danger"></i>
                    </a>
                </td>
            </tr>
        <? endforeach ?>
        </tbody>
    </table>
<? else: ?>
    <p>Записи отсутствуют.</p>
<? endif ?>
<button type="button" class="btn btn-success btn-sm todo-element-edit-js" data-bs-toggle="modal"
        data-bs-target="#todoElementModal">Добавить
</button>