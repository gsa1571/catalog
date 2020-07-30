<?php defined('CATALOG') or die('Access denied.');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=PATH?>views/css/style.css">
    <link rel="stylesheet" href="<?=PATH?>views/css/smoothness/jquery-ui-1.10.3.custom.min.css">
    <title><?=strip_tags($breadcrumbs)?></title>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <?php include 'sidebar.php'?>
        </div>
        <div class="content">
            <?php include 'menu.php'?>
           
            <p><?=$breadcrumbs?></p>
            <br>
            <hr>
            <?php if($get_one_product):?>
                <p id="product" product-id="<?=$product_id?>"><?=print_arr($get_one_product)?></p>
                <hr>
                <h3>Отзывы о товаре (<?=$count_comments?>)</h3>
                <ul class="comments">
                    <?=$comments?>
                </ul>
                <button class="open-form">Добавить отзыв</button>
            <?php else: ?>
                <p>Продукт отсутствует</p>
            <?php endif; ?>  
            <div id="form-wrap">
                <form action="<?=PATH?>add_comment" method="post" class="form">
                    <?php if(isset($_SESSION['auth']['user'])): ?>
                    <p style="display:none;">
                        <label for="comment-author">Имя:</label>
                        <input type="text" name="comment-author" id="comment-author" value="<?=htmlspecialchars($_SESSION['auth']['user'])?>">
                    </p>
                    <?php else: ?>
                    <p>
                        <label for="comment-author">Имя:</label>
                        <input type="text" name="comment-author" id="comment-author">
                    </p>
                    <?php endif; ?>
                    <p>
                        <label for="comment-text">Текст:</label>
                        <textarea name="comment-text" id="comment-text" cols="30" rows="6"></textarea>
                    </p>
                    <input type="hidden" name="parent" id="parent" value="0">
                    <!-- <p class="submit">
                        <input type="submit" value="Добавить коментарий" name="submit">
                    </p> -->
                </form>
            </div>

            <div id="loader"><span></span></div>
            <div id="errors">Ошибка</div>    

        </div>
    </div>

    <script src="<?=PATH?>views/js/jquery-1.9.0.min.js"></script>
    <script src="<?=PATH?>views/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?=PATH?>views/js/jquery.accordion.js"></script>
    <script src="<?=PATH?>views/js/jquery.cookie.js"></script>
    <script src="<?=PATH?>views/js/script.js"></script>
    <script>

$(function () {

    $("#errors").dialog({
    autoOpen: false,
    width: 450,
    modal: true,
    title: 'Сообщение об ошибке',
    resizable: false,
    draggable: false,
    show: { effect: 'slide', duration: 700},
    hide: { effect: 'explode', duration: 700},
});




$(".open-form").click(function () {
    $("#form-wrap").dialog("open");
    var parent = $(this).children().attr('data');
    //сохраняем глобально элемент по которому кликали 
    $this = $(this); 
    if(!parseInt(parent)) parent=0;
    $('input[name="parent"]').val(parent);               
});


$("#form-wrap").dialog({
    autoOpen: false,
    width: 450,
    modal: true,
    title: 'Добавление комментария',
    resizable: false,
    draggable: false,
    show: { effect: 'slide', duration: 700},
    hide: { effect: 'explode', duration: 700},
    buttons: {
        'Добавить отзыв' : function(){
            var commentAuthor = $.trim($('#comment-author').val());
            var commentText = $.trim($('#comment-text').val());
            var productId = $('#product').attr("product-id");
            var parent = $('#parent').val();

            if (commentText == '' || commentAuthor == ''){
                alert('Все поля обязательны к заполнению.');
                return;
            }
            $('#comment-text').val('');
            $(this).dialog('close');
            $.ajax({
                url: '<?=PATH?>add_comment',
                type: 'POST',
                data: { commentAuthor: commentAuthor, 
                        commentText: commentText,
                        productId: productId,
                        parent: parent 
                },
                beforeSend: function(){
                    $('#loader').fadeIn();

                },
                success: function(res){
                    var result = JSON.parse(res);
                    if(result.answer == 'Коментарий добавлен'){

                        var showComment = '<li class="new-comment" id="comment-'+result.id+'">'+result.code+'</li>';
                    
                        if (parent==0){
                            $('ul.comments').append(showComment);        
                        } else {
                            var parentComment = $this.closest('li');
                            var childs = parentComment.children('ul');
                        
                            if(childs.length==0){
                                childs.append(showComment);            
                            } else {
                                parentComment.append('<ul>'+showComment+'</ul>');
                            }
                        }

                        $('#comment-'+result.id).delay(1000).show('shake',1000);
                    } else {
                        //если клмментарий не добавлен (ошибка)
                        $('#errors').text(result.answer);
                        $('#errors').delay(1000).queue(function(){
                            $(this).dialog('open');
                            $(this).dequeue();        
                        });
                        // альтернативный вариант
                        //$('#errors').delay(1000).queue(function(){
                        //    $(this).dialog('open');
                        //    next();        
                        //});

                        //$('#errors').delay(1000).dialog('open');
                    }

                },
                complete: function(){
                    $('#loader').delay(1000).fadeOut();

                },
                error: function(){
                    alert('Ошибка!');
                }
            });
        },
        'Отмена' : function(){
            $(this).dialog('close');
            $('#comment-text').val('');
        },
    }        
});


});


    </script>


</body>
</html>