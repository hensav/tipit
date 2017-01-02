<?php
require("class/UploadTools.class.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$uploadAttempt = UploadTools::uploadImage($_FILES);
var_dump($uploadAttempt);
?>