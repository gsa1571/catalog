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
            <div>
                <select name="perpage" id="perpage">
                    <?php foreach($option_perpage as $value): ?>
                        <option <?php if($perpage==$value) echo "selected"; ?> value="<?=$value?>"><?=$value?> товаров на страницу</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <?php if($products) : ?>
                <?php if($count_pages>1): ?>
                    <div class="pagination"><?=$pagenation?></div>
                <?php endif; ?>    
                <?php foreach($products as $item) : ?>
                    <!-- <a href="<?=PATH?>product/<?=$item['id']?>"><?=$item['title']?></a> <br> -->
                    <a href="<?=PATH?>product/<?=$item['alias']?>"><?=$item['title']?></a> <br>
                <?php endforeach; ?>
                <?php if($count_pages>1): ?>
                    <div class="pagination"><?=$pagenation?></div>
                <?php endif; ?>    
            <?php else : ?>
                <p>Товаров нет</p>

            <?php endif; ?>

        </div>
    </div>

    <script src="<?=PATH?>views/js/jquery-1.9.0.min.js"></script>
    <script src="<?=PATH?>views/js/jquery.cookie.js"></script>
    <script src="<?=PATH?>views/js/jquery.accordion.js"></script>
    <script>
        $(function(){
            $('.category').dcAccordion();
            
            $('#perpage').change(function(){
                var perPage = this.value;
                //$.cookie('per_page', perPage,  {expires : 7, path : '/category/'});
                $.cookie('per_page', perPage,  {expires : 7});
                window.location = location.href;
            });
		});
    </script>
</body>
</html>