<?php defined('CATALOG') or die('Access denied.');
include 'main_controller.php';
include "models/{$view}_model.php";

$breadcrumbs = "<a href='".PATH."'>Главная</a> / "; 

if (isset($page_alias)){
    $page = get_one_page($page_alias);
    $breadcrumbs .= $page['title'];    
} else $page_alias = null;

include "views/{$view}.php";
?>