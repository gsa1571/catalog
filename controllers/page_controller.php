<?php defined('CATALOG') or die('Access denied.');
include 'main_controller.php';
include "models/{$view}_model.php";

$breadcrumbs = "<a href='".PATH."'>Главная</a> / "; 

if (!isset($page_alias)) $page_alias = 'index';
$page = get_one_page($page_alias);

if(!$page) {
    include 'views/404.php';
    exit;
}

$breadcrumbs .= $page['title'];    

include "views/{$view}.php";
?>