<?php defined('CATALOG') or die('Access denied.');
include 'config.php';
include 'models/main_model.php';

$categories = get_cat();
$categories_tree = map_tree($categories);

if(!isset($category_id)){
    $category_id = null;
    $parent_categories_tree = $categories_tree;
} 
else {
    $parent_cut = get_parent_category($category_id, $categories);    
    $parent_categories_tree[$parent_cut['id']] = $categories_tree[$parent_cut['id']];
} 

$categories_menu = categories_to_string($parent_categories_tree);

$navpages = get_pages();

?>