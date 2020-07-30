<?php defined('CATALOG') or die('Access denied.');?>

<div class="form auth">
    <div id="auth">
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
        <p><a href="#">Регистрация</a> | <a id="forgot-link" href="#">Забыли пароль?</a></p>
        <?php if(isset($_SESSION['auth']['error'])): ?>    
            <div class="error"><?=$_SESSION['auth']['error']?></div>
            <?php unset($_SESSION['auth']['error']);?>
        <?php endif; ?>    
        <?php if(isset($_SESSION['auth']['ok'])): ?>    
            <div class="ok"><?=$_SESSION['auth']['ok']?></div>
            <?php unset($_SESSION['auth']['ok']);?>
        <?php endif; ?>    
        <? else: ?>
        <p>Добро пожаловать, <b><?=htmlspecialchars($_SESSION['auth']['user'])?></b></p>
        <p><a href="<?=PATH?>logout">Выход</a></p>    
        <?php endif; ?>
    </div>

    <div id="forgot">
        <form action="<?=PATH?>forgot" method="post">
        <p>
            <label for="email">E-mail регистрации:</label>
            <input type="text" name="email" id="email"> 
        </p>    
        <p class="submit">
            <input type="submit" value="Выслать пароль" name="fpass">
        </p>
        </form>
        <p><a id="auth-link" href="">Вход на сайт</a></p>
    </div>
</div>

<ul class="category">
    <?=$categories_menu?>
</ul>
