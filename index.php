<?php
DEFINE('DS', DIRECTORY_SEPARATOR);
define("APP_PATH", __DIR__. DS. '..'. DS. 'app'. DS);
set_include_path(APP_PATH); // adding new path to include_path
spl_autoload_extensions(".php"); // comma-separated list
spl_autoload_register();

include ('config.php');

// Соединяемся с БД
$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

ini_set('display_errors', 1);
require_once 'app/bootstrap.php';
