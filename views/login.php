<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$url = "http://naturaalmajand.us/tipit/api/request.php/";

require("./class/clientAuth.class.php");

$clientAuth = new clientAuth;

/*$user = "veljo@naturaalmajand.us";
$pass = "parool";
$result = $clientAuth -> loginRequest($url,$user,$pass);
var_dump($result);
*/


// MUUTUJAD

$loginEmail = "";
$loginEmailError = "";
$loginPassword = "";
$loginPasswordError = "";
$phone = "";
$errorClass = "input-error";


// e-mail error handling
if (isset($_POST["loginEmail"])) {
    if (empty ($_POST["loginEmail"])) {
        $loginEmailError = $errorClass;
    } else {
        $loginEmail = $_POST["loginEmail"];
    }
}
//Password error handling
if (isset($_POST["loginPassword"])) {
    if (empty ($_POST["loginPassword"])) {
        $loginPasswordError = $errorClass;
    } else {
        $loginPassword = $_POST["loginPassword"];
    }
}

//checking if loginEmail and loginPassword have been posted
if (isset($_POST["loginEmail"]) && isset($_POST["loginPassword"])){
//replacing empty (non-obligatory) fields with empty strings to avoid api url bugs
    if(empty($_POST['phone'])){
        $phone='';
    } else {
        $phone=$_POST['phone'];
    }

    //$result = $clientAuth -> loginRequest($url,$user,$pass);
    $result = $clientAuth->loginRequest($url,$_POST['loginEmail'],$_POST['loginPassword'],$phone);
    var_dump($result);
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>tipit dirty login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./main.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,900" rel="stylesheet">
    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
</head>
<body>
<div class="wrapper">

<div class="login">

    <form method="POST" class="login__form">
        <input type ="email" placeholder="your e-mail" name="loginEmail" class="form__field" value="<?=$loginEmail;?>">
        <input type="password" placeholder="password" name="loginPassword" class="form__field <?=$signupPasswordError ?>">
        <input type="submit" value="login" class="form__button">
    </form>

</div>
    </div>
</body>
</html>











