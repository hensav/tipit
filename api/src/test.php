<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



require('../../../dbdata.php');
require('Public.class.php');

header('Access-Control-Allow-Origin: *');

$PDO = new PDO("mysql:dbname=$dbname;host=$location",$user,$pass,

    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")

);

$return = $_GET['requested'];
$User = new Employee($PDO,$_GET['id']);
$output = $User->fetch($return);
print_r(json_encode($output));