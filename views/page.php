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
            
            <?=$page['text']?>
            
        </div>
    </div>

    <script src="<?=PATH?>views/js/jquery-1.9.0.min.js"></script>
    <script src="<?=PATH?>views/js/jquery.cookie.js"></script>
    <script src="<?=PATH?>views/js/jquery.accordion.js"></script>
    <script src="<?=PATH?>views/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?=PATH?>views/js/script.js"></script>
</body>
</html>