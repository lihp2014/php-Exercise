<?php
$dsn="mysql:host=localhost;dbname=demo";
$db_user="root";
$db_pass="yourpassword";
$timezone="Asia/Shanghai";

$pdo = new PDO($dsn,$db_user,$db_pass);

header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set($timezone); //北京时间
?>