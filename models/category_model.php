<?php defined('CATALOG') or die('Access denied.');

/**
 * 
 **/
function get_child($id, $array){
    if (!$id) return false;
    $data = null;
    foreach($array as $item){
        if ($item['parent'] == $id){
            $data .= $item['id'] . ',';
            $data .= get_child($item['id'], $array);
        } 
    }

    return $data;
}

/**
 * 
 **/
function get_products($ids=0, $start_pos, $perpage)
{
    global $connection;

    $query = 'SELECT * FROM products ';
    if ($ids){
        $query .= "WHERE parent IN ($ids) ";
    }
    $query .= "ORDER BY title LIMIT $start_pos, $perpage";

    $res = mysqli_query($connection, $query);

    $arr_products = [];
    while($row = mysqli_fetch_assoc($res)){
        $arr_products[$row['id']] = $row;
    }

    return $arr_products;
}

/**
 * 
 **/
function get_count_products($ids=0){
    global $connection;

    $query = 'SELECT COUNT(*) FROM products ';
    if ($ids) $query .= "WHERE parent IN ($ids)";
    
    $res = mysqli_query($connection, $query);
    $count_items = mysqli_fetch_row($res);

    return $count_items[0];
}


?>