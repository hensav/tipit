<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$url = "http://naturaalmajand.us/tipit/api/request.php/";

require("./class/clientAuth.class.php");

$clientAuth = new clientAuth;


$signupEmail = "";
$signupEmailError = "";
$signupPassword = "";
$signupPasswordError = "";
$role = "";
$phone = "";
$errorClass = "input-error";


// SIGNUP EMAIL
if (isset($_POST["signupEmail"])) {
    if (empty ($_POST["signupEmail"])) {
        $signupEmailError = $errorClass;
    } else {
        $signupEmail = $_POST["signupEmail"];
    }
}

if (isset($_POST["signupPassword"])) {
    if (empty ($_POST["signupPassword"])) {
        $signupPasswordError = $errorClass;
    } else {
        $signupPassword = $_POST["signupPassword"];
    }
}

// Kontrollin, kas signupEmailError ja signupPasswordError on "" ehk e-post ja parool on sisestatud

if (isset($_POST["signupEmail"]) && isset($_POST["signupPassword"])
) {
    if(empty($_POST['phone'])){
        $regPhone='';
    } else {
        $regPhone=$_POST['phone'];
    }

    $name = $_POST['firstname'].'_'.$_POST['lastname'];
    if($name=='_'){
        $name = '';
    }

    //registerRequest($url,$email,$pass,$phone,$name,$role)
    $result = $clientAuth->registerRequest($url,$_POST['signupEmail'],$_POST['signupPassword'],$regPhone,$name,$_POST['role_choice']);
    var_dump($result);

}

?>


<!DOCTYPE html>
<html>
<head>
    <title>tipit dirty</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./main.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
</head>
<body>
<div class="wrapper">


<div class="signup">
    <form method="POST" class="signup__form">
        
        <select onchange="regHide();" id='sel-role' name="role_choice" class="form__field">
                <option value="client">Client</option>
                <option value="employee">Employee</option>
                <option value="employer">Employer</option>
        </select>
        <input id='sel-phone' type="text" placeholder="phone number" name="phone" value="" class="form__field field--optional">
        <input id='sel-email' type="email" placeholder="your e-mail address" name="signupEmail" value="" class="form__field">
        <input id='sel-fName' type="text" placeholder="first name" name="firstname" value="" class="form__field field--optional">
        <input id='sel-lName' type="text" placeholder="last name" name="lastname" value="" class="form__field field--optional">
        <input id='sel-pass' type="password" class="form__field <?=$signupPasswordError ?>" name="signupPassword" placeholder="password">
        <input id='sel-register' type="submit" value="register" class="form__button">
    </form>

</div>
</div>
<script src="js/login-reg.js"></script>
</body>
</html>
