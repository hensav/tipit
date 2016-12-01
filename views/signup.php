<?php
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

if (isset($_POST["loginEmail"]) &&
    isset($_POST["loginPassword"]) &&
    empty($errorClass)
) {
    if(!isset($_POST['phone'])){
        $regPhone=null;
    } else {
        $regPhone=$_POST['phone'];
    }

    if(!isset($_POST['firstname'])){
        $regFName=null;
    } else {
        $regFName=$_POST['firstname'];
    }

    if(!isset($_POST['lastname'])){
        $regLName=null;
    } else {
        $regLName=$_POST['lastname'];
    }

    $result = $clientAuth->registerRequest($url,$_POST['signupEmail'],$_POST['pass'],$phone,$regFName.' '.$regLName,$_POST['role_choice']);
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
                <option value="Client">Client</option>
                <option value="Employee">Employee</option>
                <option value="Employer">Employer</option>
        </select>
        <input id='sel-phone' type="text" placeholder="optional phone number" name="phone" value="" class="form__field field--optional">
        <input id='sel-email' type="email" placeholder="you e-mail" name="signupEmail" value="" class="form__field">
        <input id='sel-name' type="text" placeholder="optional first name" name="firstname" value="" class="form__field field--optional">
        <input id='sel-name' type="text" placeholder="optional last name" name="lastname" value="" class="form__field field--optional">
        <input id='sel-pass' type="password" class="form__field" name="signupPassword" placeholder="password"><?php echo $signupPasswordError; ?>
        <input id='sel-register' type="submit" value="register" class="form__button">

    </form>
</div>
</div>
<script src="js/login-reg.js"></script>
</body>
</html>