<?php
//databse configuration
define('DB_HOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','gdp');
$db = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
//check connection
if($db->connect_error){
    die("connection failed: ". $db->connect_error);
}