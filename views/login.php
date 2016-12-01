<?php


/*
 * require("./functions.php");
require ("User.class.php");
$User = new User($mysqli);

require ("Helper.class.php");
$Helper = new Helper ();

if (isset($_SESSION["userid"])) {
    header("Location: data.php");
}
*/

// MUUTUJAD
$signupEmail = "";
$signupEmailError = "";
$signupPassword = "";
$signupPasswordError = "";
$loginEmail = "";
$loginEmailError = "";
$loginPassword = "";
$loginPasswordError = "";
$loginSavedEmail = "";
$role = "";
$phone = "";


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