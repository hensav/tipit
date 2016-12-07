<?php
$url = "http://naturaalmajand.us/tipit/api/request.php/";

require("./class/clientAuth.class.php");

$clientAuth = new clientAuth;
$user = "veljo@naturaalmajand.us";
$pass = "parool";
$result = $clientAuth -> loginRequest($url,$user,$pass);
var_dump($result);

