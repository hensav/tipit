<?php
/**
 * Created by PhpStorm.
 * User: clstrfvck
 * Date: 06/01/2017
 * Time: 01:36
 */

 require('../../../dbdata.php');

 header('Access-Control-Allow-Origin: *');

 $PDO = new PDO("mysql:dbname=$dbname;host=$location",$user,$pass,

     array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")

 );

 echo("hi");


 ?>