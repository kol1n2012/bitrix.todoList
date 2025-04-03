<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
/**
 * @var TodoList $component
 * @var Bitrix\Main\ORM\Entity $arResult
 * @var array $arParams
 */

$collection = $component->getCollection();
?>
<?if(count($collection)):?>
<table class="table table-striped table-hover">
	  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Наименование</th>
      <th scope="col">Описание</th>
      <th scope="col">Теги</th>
      <th scope="col"></th> 
      <th scope="col"></th>
    </tr>
  </thead>
 <tbody>
	 <?foreach($collection as $element):?>
    <tr>
      <th scope="row">1</th>
      <td><?=$element['UF_TITLE']?></td>
      <td><?=$element['UF_DESCRIPTION']?></td>
      <td>
 		<?foreach($element['UF_TAGS'] as $tag):?>
			<span class="badge text-bg-info"><?=$tag?></span>
		<?endforeach?>
		</td>
      <td class="edit">
      	<a href="#" data-mdb-tooltip-init="" aria-label="Edit" data-mdb-original-title="Edit" data-mdb-tooltip-initialized="true"  data-bs-toggle="modal" data-bs-target="#todoElementEditModal">
			<i class="fas fa-pencil fa-lg text-success" aria-hidden="true"></i>
      	</a>
       </td>
      <td class="remove">
      	<a href="#" data-mdb-tooltip-init="" aria-label="Remove" data-mdb-original-title="Remove" data-mdb-tooltip-initialized="true">
      		<i class="fas fa-trash-alt fa-lg text-danger"></i>
      	</a>
      </td>
    </tr>
	<?endforeach?>
  </tbody>
</table>
<?else:?>
<p>Записи отсутствуют.</p>
<?endif?>
<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#todoElementNewModal">Добавить</button>
<? $this->SetViewTarget('content_helper_modals'); ?>
<div class="modal fade" id="todoElementNewModal" tabindex="-1" aria-labelledby="todoElementNewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<form>
	      <div class="modal-header">
	        <h5 class="modal-title">Добавить элемент</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
	      </div>
	      <div class="modal-body">
	     
			  <div class="mb-3">
			    <label for="todoListElementNewTitle" class="form-label">Наименование</label>
			    <input type="text" class="form-control" id="todoListElementNewTitle" required>
			  </div>
			  <div class="mb-3">
			    <label for="todoListElementNewDescription" class="form-label">Описание</label>
			    <textarea class="form-control" id="todoListElementNewDescription" rows="2" required></textarea>
			  </div>
			 <div  class="col-md-6 mb-3">
			    <label for="todoListElementNewTags" class="form-label">Теги</label>
			    <input type="text" class="form-control form-control-sm mb-2 js-button-tags" aria-describedby="todoListElementNewTagsHelp">
			    <input type="text" class="form-control form-control-sm mb-2 js-button-tags" aria-describedby="todoListElementNewTagsHelp">
			    <input type="text" class="form-control form-control-sm mb-2 js-button-tags" aria-describedby="todoListElementNewTagsHelp">
			    <button type="button" class="btn btn-primary btn-sm js-button-tags-more">еще</button>
			    <div id="todoListElementNewTagsHelp" class="form-text">Нажмите "еще" чтобы добавить больше тегов</div>
			  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
	      </div>
	    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="todoElementEditModal" tabindex="-1" aria-labelledby="todoElementEditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Редактировать элемент</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
        <p>Здесь идет основной текст модального окна</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm">Сохранить</button>
      </div>
    </div>
  </div>
</div>
<script>
	//'.js-button-tags-more'
</script>
<? $this->EndViewTarget(); ?>