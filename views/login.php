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



// LOGIN EMAIL
if (isset($_POST["loginEmail"])) {
    if (empty($_POST["loginEmail"])) {
        $loginEmailError = "insert e-mail";
    }
}

if(isset($_POST["loginPassword"])){
    if(empty($_POST["loginPassword"])){
        $loginPasswordError="insert password";
    }
}

// SIGNUP EMAIL
if (isset($_POST["signupEmail"])) {
    if (empty ($_POST["signupEmail"])) {
        $signupEmailError = " field is required";
    } else {
        $signupEmail = $_POST["signupEmail"];
    }
}

if (isset($_POST["signupPassword"])) {
    if (empty ($_POST["signupPassword"])) {
        $signupPasswordError = " field is required";
    } else {
        $signupPassword = $_POST["signupPassword"];
    }
}

// Kontrollin, kas signupEmailError ja signupPasswordError on "" ehk e-post ja parool on sisestatud
if ($signupEmailError == "" &&
    $signupPasswordError == "" &&
    isset($_POST["signupEmail"]) &&
    isset($_POST["signupPassword"])
) {
//see osa on vajalik vaid testimiseks, kas eelnev on õige
    echo "Salvestan.. <br>";
    echo "email: ".$signupEmail."<br>";
    echo "parool: ".$_POST["signupPassword"]."<br>";
// parool krüpteeritakse
    $password = hash("sha512", $_POST["signupPassword"]);

    echo $password."<br>";
// signup FUNCTION
    signup($signupEmail, $password);
}

$notice = "";
//$defaultEmail = "sisesta_email";
if (isset($_POST["loginEmail"]) &&
    isset($_POST["loginPassword"]) &&
    !empty($_POST["loginEmail"]) &&
    !empty($_POST["loginPassword"])
) {
// login Autofill
    $loginSavedEmail = $_POST["loginEmail"];
//
    $notice = login ($_POST["loginEmail"], $_POST["loginPassword"]);
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>tipit dirty</title>
</head>
<body>


<div class="login">

    <form method="POST" class="login form">
        <input type = "email" placeholder="your e-mail" name="loginEmail" class="form__field" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
        <input type="text" placeholder="optional phone number" name="phone" value="" class="form__field field--optional">
        <input type="password" placeholder="password" name="signupPassword" class="form__field"><?php echo $signupPasswordError; ?>
        <input type="submit" value="login" class="form__button">
    </form>

</div>


</body>
</html>