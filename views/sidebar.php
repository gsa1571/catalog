<?php defined('CATALOG') or die('Access denied.');?>

<div class="form auth">
    <? if(!isset($_SESSION['auth']['user'])): ?> 
    <form action="<?=PATH?>login" method="post">
    <p>
        <label for="login">Логин:</label>
        <input type="text" name="login" id="login"> 
    </p>    
    <p>    
        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password">   
    </p>    
    <p class="submit">
        <input type="submit" value="Войти" name="log_in">
    </p>
    </form>
    <p><a href="#">Регистрация</a> | <a href="#">Забыли пароль?</a></p>
    <?php if(isset($_SESSION['auth']['error'])): ?>    
        <div class="error"><?=$_SESSION['auth']['error']?></div>
        <?php unset($_SESSION['auth']['error']);?>
    <?php endif; ?>    
    <? else: ?>
    <p>
        Добро пожаловать, <b><?=htmpspecialchars($_SESSION['auth']['user'])?></b>
    </p>
    <?php endif; ?>
</div>

<ul class="category">
    <?=$categories_menu?>
</ul>
