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
            
            <h3>Восстановление пароля</h3>
            <?php if(isset($_SESSION['forgot']['change_error'])): ?>
                <div class="error"><?=$_SESSION['forgot']['change_error']?></div>
                <?php unset($_SESSION['forgot']['change_error'])?>
                <div class="form auth">
                    <form action="<?=PATH?>/forgot" method="post">
                        <p>    
                            <label for="new_password">Новый пароль:</label>
                            <input type="password" name="new_password" id="new_password">   
                        </p> 
                        <input type="hidden" name="hash" value="<?=$_POST['hash']?>">
                        <p class="submit">
                            <input type="submit" value="Войти" name="change_pass">
                        </p>
                    </form>
                </div>
            <?php elseif(isset($_SESSION['forgot']['ok'])): ?>
                <div class="ok"><?=$_SESSION['forgot']['ok']?></div>
                <?php unset($_SESSION['forgot']['ok'])?>
            <?php elseif(isset($_SESSION['forgot']['errors'])): ?>
                <div class="error"><?=$_SESSION['forgot']['errors']?></div>
                <?php unset($_SESSION['forgot']['errors'])?>
            <?else: ?> 
                <div class="form auth">
                    <form action="<?=PATH?>/forgot" method="post">
                        <p>    
                            <label for="new_password">Новый пароль:</label>
                            <input type="password" name="new_password" id="new_password">   
                        </p> 
                        <input type="hidden" name="hash" value="<?=$_GET['forgot']?>">
                        <p class="submit">
                            <input type="submit" value="Войти" name="change_pass">
                        </p>
                    </form>
                </div>

            <?php endif; ?>
        </div>
    </div>

    <script src="<?=PATH?>views/js/jquery-1.9.0.min.js"></script>
    <script src="<?=PATH?>views/js/jquery.cookie.js"></script>
    <script src="<?=PATH?>views/js/jquery.accordion.js"></script>
    <script src="<?=PATH?>views/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?=PATH?>views/js/script.js"></script>
</body>
</html>