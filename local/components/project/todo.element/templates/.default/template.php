<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
/**
 * @var TodoElement $component
 * @var Bitrix\Main\ORM\Entity $arResult
 * @var array $arParams
 */

$element = $component->getElement();
?>
<div class="modal fade" id="todoElementModal" tabindex="-1" aria-labelledby="todoElementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="todoElementModalForm">
                <? if ($element['ID']): ?>
                    <input type="hidden" name="ID" value="<?= $element['ID'] ?>">
                <? endif ?>
                <div class="modal-header">
                    <h5 class="modal-title"><?= $element['ID'] ? 'Редактировать' : 'Добавить' ?> элемент</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="todoListElementNewTitle" class="form-label">Наименование</label>
                        <input type="text" name="UF_TITLE" class="form-control" id="todoListElementNewTitle" required
                               value="<?= $element['UF_TITLE'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="todoListElementNewDescription" class="form-label">Описание</label>
                        <textarea class="form-control" name="UF_DESCRIPTION" id="todoListElementNewDescription" rows="2"
                                  required><?= $element['UF_DESCRIPTION'] ?? '' ?></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="todoListElementNewTags" class="form-label">Теги</label>
                        <? if ($element['UF_TAGS'] && count($element['UF_TAGS'])): ?>
                            <? foreach ($element['UF_TAGS'] as $tag): ?>
                                <input type="text" name="UF_TAGS[]"
                                       class="form-control form-control-sm mb-2 js-button-tags"
                                       aria-describedby="todoListElementNewTagsHelp" value="<?= $tag ?>">
                            <? endforeach ?>
                        <? else: ?>
                            <input type="text" name="UF_TAGS[]" class="form-control form-control-sm mb-2 js-button-tags"
                                   aria-describedby="todoListElementNewTagsHelp">
                        <? endif ?>
                        <button type="button" class="btn btn-primary btn-sm js-button-tags-more">еще</button>
                        <div id="todoListElementNewTagsHelp" class="form-text">Нажмите "еще" чтобы добавить больше
                            тегов
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm js-todoListElement-modal-button-save">
                        Сохранить
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>