$(function(){

    $(".open-form").click(function () {
        $("#form-wrap").dialog("open");
    });

    $("#form-wrap").dialog({
        autoOpen: false,
        width: 450,
        modal: true,
        resizable: false,
        draggable: false,
        show: { effect: 'slide', duration: 700},
        hide: { effect: 'explode', duration: 700},
        buttons: {
            'Добавить отзыв' : function(){
                var commentAuthor = $('#comment-author').val();
                var commentText = $('#comment-text').val();
                var productId = <?=$product_id?>;
                var parent = $('#parent').val();

                if (commentAuthor=='' || commentText == ''){
                    alert('Поля формы обязательны к заполнению!');
                    return;
                } 
                $('comment_text').val('');
                $(this).dialog('close');

            },
            'Отмена' : function(){
                $('comment_text').val('');
                $(this).dialog('close');                
            },
        }        
    });


});

