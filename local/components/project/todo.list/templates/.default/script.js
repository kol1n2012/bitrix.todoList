$(function () {
    //кнопки добавления записи и редактирования
    $(document).on("click", ".todo-element-edit-js", function () {
        var request = $.ajax({
                url: '/todo_list/element.php',
                method: 'POST',
                data: {
                ID: $(this).data('id'),
                sessid: BX.message('bitrix_sessid')
            }
        });
        
        request.done(function (modal) {
            let modalContent = $(modal).find('.modal-content');
            $('#todoElementModal .modal-dialog').html(modalContent);
        });
    });
    
    //кнопки удаления записи и редактирования
    $(document).on("click", ".todo-element-remove-js", function () {
        var data = {
            id: $(this).data('id'),
            sessid: BX.message('bitrix_sessid')
        };

        var request = $.ajax({
                url: '/bitrix/services/main/ajax.php?' + $.param({
                c: 'project:todo.element',
                action: 'remove',
                mode: 'class'
            }, true),
            method: 'POST',
            data: data
        });

        request.done(function (response) {
            pageUpdate();
        });
    });

    //кнопка "еще" для добавления тегов в модальном окне
    $(document).on("click", ".js-button-tags-more", function () {
        var $element = $(this).parent().find('.js-button-tags').eq(0).clone().prop('value', '');
        $(this).before($element);
    });

    //кнопка сохранения в модальном окне
    $(document).on("submit", "#todoElementModalForm", function (e) {

        e.preventDefault();

        var data = {
            data: $(this).serialize(),
            sessid: BX.message('bitrix_sessid')
        };

        var request = $.ajax({
                url: '/bitrix/services/main/ajax.php?' + $.param({
                c: 'project:todo.element',
                action: 'save',
                mode: 'class'
            }, true),
            method: 'POST',
            data: data
        });

        request.done(function (response) {
            var myModalEl = document.getElementById('todoElementModal');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();
            pageUpdate();
        });

    });  

    //обработчик обновления страницы
    function pageUpdate()
    {
        var request = $.ajax({
                url: '/todo_list/',
                method: 'GET',
                data: {}
        });
        
        request.done(function (page) {
            let pageContent = $(page).find('#workarea-inner');
            $('#workarea').html(pageContent);
        });
    }

});  