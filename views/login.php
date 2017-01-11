<?php

//// Handling already logged in users
session_start();
if(isset($_SESSION['userRole'])){
    $role = $_SESSION['userRole'];
    if($role=='client'){
        header('location: tiping.php');
        exit();
    } elseif($role=='employee'){
        header('location: emp_welcome.php');
        exit();
    }elseif($role=='employer'){

        require('class/compWelcome.class.php');
        $new = compWelcome::isEmployerNew($_SESSION['apiKey'],$_SESSION['userId']);
        if(!!$new){
            header('location: comp_welcome.php');
        } else {
            header('location: manageWorkforce.php');
        }
        exit();
    }

    //..And to make sure noone's f^cking around with their session data:
    exit();
}

require("./class/clientAuth.class.php");
$url = "http://naturaalmajand.us/tipit/api/request.php/";
$clientAuth = new clientAuth;

// Initializing

$loginEmail = "";
$loginEmailError = "";
$loginPasswordError = "";
$phone = "";
$errorMessage = "";


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
if (isset($_POST["loginEmail"]) && isset($_POST["loginPassword"])
    && !empty($_POST['loginEmail']) && !empty($_POST['loginPassword'])) {

    $result = $clientAuth->loginRequest($url,$_POST['loginEmail'],$_POST['loginPassword'],$phone);
    if ($result->status == "success") {
        session_destroy();
        session_start();
        $_SESSION['userId'] = $result->response->id;
        $_SESSION['userRole'] = $result->response->role;
        $_SESSION['apiKey'] = $result->response->apikey;
        if($result->response->role =="client"){
            $location = "tiping.php";
        } elseif ($result->response->role == "employer") {
            require('class/compWelcome.class.php');
            $new = compWelcome::isEmployerNew($_SESSION['apiKey'],$_SESSION['userId']);
            if(!!$new){
                $location = "comp_welcome.php";
            } else {
                $location =  "manageWorkforce.php";
            }
        } elseif ($result->response->role == "employee"){
            $location = "employeeSelfData.php";
        }
        header("location: $location");
        exit();



    }else {

        $errorMessage = "Wrong details";

    }


}


?>
<?php require("header.php"); ?> 

<div class="login">


    <form method="POST" class="login__form">
        <input type ="email" placeholder="your e-mail" name="loginEmail" value="<?=$loginEmail;?>" class="form__field <?=$loginEmailError ?>">
        <input type="password" placeholder="password" name="loginPassword" class="form__field <?=$loginPasswordError ?>">
        <?php echo($errorMessage); ?>

        <input type="submit" value="login" class="form__button">
    </form>

</div>
</div>

<?php require("footer.php"); ?>










