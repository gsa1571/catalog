<?php defined('CATALOG') or die('Access denied.');
include 'models/main_model.php';

if(!isset($category_id)) $category_id = null;
$categories = get_cat();
$categories_tree = map_tree($categories);
$categories_menu = categories_to_string($categories_tree);

$navpages = get_pages();

?>