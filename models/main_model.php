<?php defined('CATALOG') or die('Access denied.');
/**
 * Вывод массива
 **/
function print_arr($array){
    $str = "<pre>" . print_r($array,true) . "</pre>";
    return $str; 
}

/**
 * 
 **/
function redirect($http=false){
    if ($http) $redirect = $http; 
    else $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH; 
    header("Location: $redirect");
    exit;
}

/**
 * Вывод категорий
 **/
function get_cat(){
    global $connection;
    $query = 'SELECT * FROM categories';
    $res = mysqli_query($connection, $query);

    $arr_cat = [];
    while($row = mysqli_fetch_assoc($res)){
        $arr_cat[$row['id']] = $row; 
    }

    return $arr_cat;
}

/**
* Построение дерева
**/
function map_tree($dataset) {
	$tree = [];

	foreach ($dataset as $id=>&$node) {    
		if (!$node['parent']){
			$tree[$id] = &$node;
		}else{ 
            $dataset[$node['parent']]['childs'][$id] = &$node;
		}
	}

	return $tree;
}

/**
 *  массив дерева в HTML
 */
function categories_to_string($data, $template='category_template.php'){
    $str = null;
    foreach($data as $item){
        $str .= categories_to_template($item, $template);
    }

    return $str;
}

/**
 * Вывод категории в список
 **/
function categories_to_template($category, $template){

    ob_start();
    include "views/$template";
    return ob_get_clean();
}

/**
*
**/
function pagination($page, $count_pages, $modrew=true){
    $back = null;
    $forward = null;
    $startpage = null;
    $endpage = null;
    $page2left = null;
    $page1left = null;
    $page1right = null;
    $page2right = null;
    $pagecurrent = null;

    $uri = "?";
	if (!$modrew){
		if ($_SERVER['QUERY_STRING']){
			foreach($_GET as $key => $value){
				if($key != 'page') $uri .= "{$key}=$value&amp;";  
			}
		}
	} else {
        $url = null;
        if(isset($_SERVER['REQUES_URI'])){
		    $url = $_SERVER['REQUES_URI'];
            $url = explode('?', $url);
        }    
		// второе условие - исключение строки запроса
		// http://localhost/catalog/category/701/?
		if (isset($url[1]) && url[1] != ""){
			$param = explode('&', $url[1]);
			
			foreach($param as $key => $value){
				if(!preg_match('#page=#')) $uri .= "$value&amp;";  
			}
		}
	}	

    if($page>1) {
        $back="<a class='nav-link' href='{$uri}page=".($page-1)."'>&lt;</a>";
    }
    if($page<$count_pages) {
        $forward="<a class='nav-link' href='{$uri}page=".($page+1)."'>&gt;</a>";
    }
    if($page>3) {
        $startpage="<a class='nav-link' href='{$uri}page=1'>&laquo;</a>";
    }
    if($page<($count_pages-2)) {
        $endpage="<a class='nav-link' href='{$uri}page=".$count_pages."'>&raquo;</a>";
    }
    if($page-2>0) {
        $page2left="<a class='nav-link' href='{$uri}page=".($page-2)."'>".($page-2)."</a>";
    }
    if($page-1>0) {
        $page1left="<a class='nav-link' href='{$uri}page=".($page-1)."'>".($page-1)."</a>";
    }
    if($page+1<=$count_pages) {
        $page1right="<a class='nav-link' href='{$uri}page=".($page+1)."'>".($page+1)."</a>";
    }
    if($page+2<=$count_pages) {
        $page2right="<a class='nav-link' href='{$uri}page=".($page+2)."'>".($page+2)."</a>";
    }
    $pagecurrent = "<a class='nav-link-current'>$page</a>";

    return $startpage.$back.$page2left.$page1left.$pagecurrent.$page1right.$page2right.$forward.$endpage;
}

/**
 * 
 **/
function breadcrumbs($id, $array) {
    if (!$id) return false;

    $len = count($array);
    $breadcrumbs_array = [];

    for($i=0; $i<$len; $i++){
        if (isset($array[$id])){
            $breadcrumbs_array[$array[$id]['id']] = $array[$id]['title'];
            $id = $array[$id]['parent'];
        } else break;  
    }
    return array_reverse($breadcrumbs_array, true);
}


/**
 * Вывод перечня страниц меню
 **/
function get_pages(){
    global $connection;
    $query = 'SELECT title, alias FROM pages ORDER by position ASC';
    $res = mysqli_query($connection, $query);

    $arr_pages = [];
    while($row = mysqli_fetch_assoc($res)){
        $arr_pages[$row['alias']] = $row['title']; 
    }

    return $arr_pages;
}

/**
 *  Вывод меню страниц в HTML
 */
function pages_to_string($data){
    $str = null;
    foreach($data as $navpage){
        $str .= pages_to_template($navpage);
    }

    return $str;
}

/**
 * Вывод меню страниц по шаблону
 **/
function pages_to_template($navpage){
    ob_start();
        include 'views/pages_template.php';
    return ob_get_clean();
}


?>