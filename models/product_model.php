<?php defined('CATALOG') or die('Access denied.');

/**
 * 
 **/
//function get_one_product($id)
function get_one_product($product_alias)
{
    global $connection;

    //$query = "SELECT * FROM products WHERE id=$id LIMIT 1";
    $product_alias = mysqli_real_escape_string($connection, $product_alias);
    $query = "SELECT * FROM `products` WHERE `alias`='$product_alias' LIMIT 1";
    $res = mysqli_query($connection, $query);

    return mysqli_fetch_assoc($res);
}

/**
 * 
 **/
function get_comments($product_id){
    global $connection;

    $comments = [];

    $product_id = mysqli_real_escape_string($connection, $product_id);
    $query = "SELECT * FROM `comments` WHERE `comment_product`= $product_id";
    $res = mysqli_query($connection, $query);
    
    while ($row = mysqli_fetch_assoc($res)){
        $comments[$row['comment_id']] = $row;        
    } 

    return $comments;
}


?>