<?php defined('CATALOG') or die('Access denied.');
include 'main_controller.php';
include "models/{$view}_model.php";

if (isset($product_alias)){
    $get_one_product = get_one_product($product_alias);
    
    $category_id = $get_one_product['parent'];
}
else $get_one_product = null;

include 'libs/breadcrumbs.php';

include "views/{$view}.php";
?>