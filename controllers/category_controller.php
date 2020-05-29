<?php defined('CATALOG') or die('Access denied.');
include 'main_controller.php';
include "models/{$view}_model.php";

include 'libs/breadcrumbs.php';
// id дочерних категорий
$ids = get_child($category_id, $categories);
$ids = !$ids ? $category_id : rtrim($ids,',');

// pagination
$perpage = (isset($_COOKIE['per_page']) && $_COOKIE['per_page']) ? $_COOKIE['per_page'] : PERPAGE;
$count_goods = get_count_products($ids);
$count_pages = ceil($count_goods / $perpage);


if(!$count_pages) $count_pages=1;

if(isset($_GET['page'])){
    $page = (int)$_GET['page'];
    if($page<1) $page=1;
} else {
    $page=1;
}

if ($page>$count_pages) $page=$count_pages;
$start_pos = ($page-1)*$perpage;

$pagenation = pagination($page, $count_pages);
// pagination

$products = get_products($ids, $start_pos, $perpage);

include "views/{$view}.php";

?>