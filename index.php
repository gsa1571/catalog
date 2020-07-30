<?php
error_reporting(E_ALL);
define('CATALOG', true);
session_start();



// ?P<product_alias> - именованные ячейка хранения шаблона
$routes = [
    ['url' => '#^product/(?P<product_alias>[a-z0-9-]+)#i', 'view' => 'product' ],
    ['url' => '#^category/(?P<category_id>\d+)#i', 'view' => 'category' ],
    ['url' => '#^page/(?P<page_alias>[a-z0-9-]+)#i', 'view' => 'page' ],
    ['url' => '#^add_comment#i', 'view' => 'add_comment' ],
    ['url' => '#^login#i', 'view' => 'login' ],
    ['url' => '#^logout#i', 'view' => 'logout' ],
    ['url' => '#^forgot#i', 'view' => 'forgot' ],
    ['url' => '#^$|^\?#' , 'view' => 'category']
];

//$url=str_replace('/catalog/','',$_SERVER['REQUEST_URI']);
$url=ltrim($_SERVER['REQUEST_URI'],'/');


foreach ($routes as $route){
    if(preg_match($route['url'], $url, $match)){
        $view = $route['view']; 
        break;
    }
}

if ( empty($match) ){
    include 'views/404.php';
    exit;
}

// извлекает из массива значения 
//и создаст переменные $product_alias и $id
extract($match);
include 'config.php';
include "controllers/{$view}_controller.php";
?>