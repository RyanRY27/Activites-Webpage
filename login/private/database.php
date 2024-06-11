<?php

define('DB_NAME', 'login');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');



$str = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
if(!$con = new PDO($str,DB_USER,DB_PASS))
{
	die("Failed to connect");
}

