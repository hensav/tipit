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

$User = new Employee($PDO,140);
$User2 = new Employee($PDO,139);
$clientside = $User->fetch(array(
   "description","name","id","apikey"
));

$clientside2 = $User2->fetch("name");
var_dump($clientside);
var_dump($clientside2);