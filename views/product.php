<?php defined('CATALOG') or die('Access denied.');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=PATH?>views/css/style.css">
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
            <?php if($get_one_product): ?>
                <p><?=print_arr($get_one_product)?></p>
            <?php else: ?>
                <p>Продукт отсутствует</p>
            <?php endif; ?>  
            <hr>
            <h3>Отзывы о товаре(0)</h3>
            <ul class="comments">
                <?=$comments?>
            </ul>

        </div>
    </div>

    <script src="<?=PATH?>views/js/jquery-1.9.0.min.js"></script>
    <script src="<?=PATH?>views/js/jquery.cookie.js"></script>
    <script src="<?=PATH?>views/js/jquery.accordion.js"></script>
    <script>
        $(function(){
			$(".category").dcAccordion();
		});
    </script>
</body>
</html>