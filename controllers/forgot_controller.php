<?php defined('CATALOG') or die('Access denied.');
include 'main_controller.php';
include "models/{$view}_model.php";

// Авторизованный пользователь не может сменить пароль
if (isset($_SESSION['auth']['user'])) redirect(PATH);

if (isset($_POST['fpass'])) {
    forgot();
    redirect();
} elseif (isset($_GET['forgot'])){
    $breadcrumbs = "<a href='".PATH."'>Главная</a> / Восстановление пароля ";
    acces_change();
    include "views/{$view}.php";
}    
  elseif (isset($_POST['change_pass'])) {
    change_forgot_password();
    redirect( PATH . "forgot/?forgot={$_POST['hash']}" );
             
} else {
    redirect(PATH);
}

?>