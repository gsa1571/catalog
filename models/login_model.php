<?php defined('CATALOG') or die('Access denied.');

function authorization(){
    global $connection;

    $login = trim(mysqli_real_escape_string($connection, $_POST['login']));
    $password = trim(mysqli_real_escape_string($connection,$_POST['password']));

    if(empty($login) OR empty($password)) {
        $_SESSION['auth']['error'] = 'Поля логин/пароль обязательны к заполнению';
    } else {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE login='$login' AND password='$password' LIMIT 1";
        $res = mysqli_query($connection, $query);
        if(mysqli_num_rows($res)==1){
            $row = mysqli_fetch_accos($res);
            $_SESSION['auth']['user'] = $res['name'];
            $_SESSION['auth']['is_admin'] = $res['is_admin'];
        } else {
            $_SESSION['auth']['error'] = 'Логин и пароль введены неверно';
        }
    }
  }

?>