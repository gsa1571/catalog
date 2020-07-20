<?php defined('CATALOG') or die('Access denied.');
include 'main_controller.php';
include "models/{$view}_model.php";

if (isset($product_alias)){
    $get_one_product = get_one_product($product_alias);
    $category_id = $get_one_product['parent'];

    //ID item
    $product_id = $get_one_product['id'];
    $count_comments = count_comments($product_id);
    $get_comments = get_comments($product_id);
    $comments_tree = map_tree($get_comments);
    $comments = categories_to_string($comments_tree, 'comments_template.php');
} 
   else
    $get_one_product = null;

include 'libs/breadcrumbs.php';

include "views/{$view}.php";
?>