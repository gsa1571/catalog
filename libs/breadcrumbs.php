<?php defined('CATALOG') or die('Access denied.');


$breadcrumbs_array = breadcrumbs($category_id, $categories);

if (!isset($get_one_product)) $get_one_product=null;

$breadcrumbs = "<a href='".PATH."'>Главная</a> / "; 
if ($breadcrumbs_array){
    $len = count($breadcrumbs_array); 
    foreach($breadcrumbs_array as $key => $value){
        if (--$len || $get_one_product)
        $breadcrumbs .= "<a href='".PATH."category/{$key}'>{$value}</a> / ";
        else
        $breadcrumbs .= $value;
    }

    if($get_one_product) $breadcrumbs .= $get_one_product['title'];
} else $breadcrumbs .= "Каталог";



?>