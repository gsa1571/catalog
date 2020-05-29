<?php defined('CATALOG') or die('Access denied.');

define("DB","apple");
define("DBUSER","root");
define("DBPASS","");
define("DBHOST","127.0.0.1");
define("PATH","http://catalog.loc/");
define("PERPAGE",5);

$modrew=true;

$option_perpage = [5,10,15];

$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die("Ошибка подключения к базе данных");
mysqli_set_charset($connection,"utf8") or die("Ошибка установки кодировки соединения");