<?php defined('CATALOG') or die('Access denied.');

/**
 * 
 **/
function forgot()
{
    global $connection;

    $email = mysqli_real_escape_string($connection, $_POST['email']);

    if(empty($email)){
        $_SESSION['auth']['error']='Поле email не заполнено';
        return;
    }

    $query = "SELECT `id` FROM users WHERE email='$email' LIMIT 1";
    $res = mysqli_query($connection, $query);

    if(mysqli_num_rows($res)==1){
        $row = mysqli_fetch_assoc($res);
        $expire = time()+3600;
        $hash = md5($expire . $email);
        $query = "INSERT INTO `forgot` (`hash`, `expire`, `email`, `user_id`) VALUES('$hash', $expire, '$email', {$row['id']} )";
        $res = mysqli_query($connection, $query);
        if(mysqli_affected_rows($connection)>0){
            $link = PATH . "forgot/?forgot=$hash";
            $subject = 'Запрос на восстановление пароля на сайте ' . PATH;
            $body = "Перрейдите по ссылке <a href='$link'>$link</a> для восстановления пароля.
                     Ссылка активна в течении 1 часа.";
            $headers = "FROM: " . strtoupper($_SERVER['SERVER_NAME']) . "\r\n";
            $headers .= "Content-type:text/html; charset = utf-8";
            mail($email, $subject, $body, $headers);

            $_SESSION['auth']['ok'] = 'На Ваш e-mail отправлено письмо для восстановления пароля.';
        }

    } else {
        $_SESSION['auth']['error'] = 'Такой email не зарегистрирован';
    }
}

/**
 *
 **/
function acces_change(){
    global $connection;

    $hash = mysqli_real_escape_string($connection, $_GET['forgot']);
    if (empty($hash)) {
        $_SESSION['forgot']['errors'] = 'Ссылка восстановления пароля некорректна.';
        return;
    }

    $query = "SELECT * FROM forgot WHERE `hash`= '$hash' LIMIT 1";
    $res = mysqli_query($connection, $query);

    if (!mysqli_num_rows($res)){
        $_SESSION['forgot']['errors'] = 'Ссылка восстановления пароля некорректна.
        Пройдите процедуру восстановления пароля заново.';
        return;
    }

    $row = mysqli_fetch_assoc($res);
    $now = time();
    if ($now>$row['expire']){
        $_SESSION['forgot']['errors'] = 'Ссылка восстановления пароля устарела.
        Пройдите процедуру восстановления пароля заново.';
        return;
    }
}

function change_forgot_password(){
    global $connection;

    $new_password = mysqli_real_escape_string($connection, $_POST['new_password']);
    if (empty($new_password)) {
        $_SESSION['forgot']['change_error'] = 'Значение пароля неможет быть пустым.';
        return;
    }

    $query = "SELECT * FROM forgot WHERE `hash`= '{$_POST['hash']}' ";
    $res = mysqli_query($connection, $query);

    if (!mysqli_num_rows($res)) return;
    // Ошибка будет обработана acces_change() по редиректу 

    $row = mysqli_fetch_assoc($res);
    $now = time();
    if ($now>$row['expire']){
        mysqli_query($connection, "DELETE FROM `forgot` WHERE `expire` < $now");
        return;
    }

    $password = $_POST['new_password'];
    mysqli_query($connection, "UPDATE `users` SET `password`= '$password' WHERE `id` = {$row['user_id']}");    
    mysqli_query($connection, "DELETE FROM `forgot` WHERE user_id = {$row['user_id']} ");
    $_SESSION['forgot']['ok'] = 'Пароль успешно изменен.';
}

?>