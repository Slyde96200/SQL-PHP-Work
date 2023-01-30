<?php
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_DATABASE', 'colyseum');
define('DB_USERNAME', 'sqluser1');
define('DB_PASSWORD', 'test');

$database = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
$database->exec("SET NAMES 'utf8'");
?>