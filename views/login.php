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
if (isset($_POST["loginEmail"]) &&
    isset($_POST["loginPassword"])){
//replacing empty (non-obligatory) fields with empty strings to avoid api url bugs
    if(empty($_POST['phone'])){
        $phone='';
    } else {
        $phone=$_POST['phone'];
    }

    //$result = $clientAuth -> loginRequest($url,$user,$pass);
    $result = $clientAuth->loginRequest($url,$_POST['loginEmail'],$_POST['loginPassword'],$phone);
    if($result->status == "success"){
        session_start();
        $_SESSION['userId'] = $result->response->id;
        $_SESSION['userRole'] = $result->response->role;
        $_SESSION['apiKey'] = $result->response->apikey;
        if($result->response->role =="client"){
            $location = "tiping.php";
        } elseif ($result->response->role == "employer"){
            $location = "comp_welcome.php";
        } elseif ($result->response->role == "employee"){
            $location = "emp_welcome.php";
        }
        header("location: $location");
        exit();
    }
}

?>
<?php require("header.php"); ?> 

<div class="login">

    <form method="POST" class="login__form">
        <input type ="email" placeholder="your e-mail" name="loginEmail" value="<?=$loginEmail;?>" class="form__field <?=$loginEmailError ?>">
        <input type="password" placeholder="password" name="loginPassword" class="form__field <?=$signupPasswordError ?>">
        <input type="submit" value="login" class="form__button">
    </form>

</div>
</div>

<?php require("footer.php"); ?>










