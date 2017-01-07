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
$role_choice = "";
$phone = "";
$errorClass = "input-error";
$nameError = "";
$phoneError = "";
$errorMessage = "";
$error = false;


//Default role & post-error select retention
$rolesel = 'client';
if (isset($_POST['role_choice'])) {
    $rolesel = $_POST['role_choice'];
}
$sel_client = '';
$sel_employee = '';
$sel_employer = '';
if($rolesel == 'employee') {
    $sel_employee = "selected = 'selected'";
} elseif ($rolesel == 'employer') {
    $sel_employer = "selected = 'selected'";
} else {
    $sel_client = "selected = 'selected'";
}

// e-mail error handling
if (isset($_POST["signupEmail"])) {
    if (empty ($_POST["signupEmail"])) {
        $signupEmailError = $errorClass;
    } else {
        $signupEmail = $_POST["signupEmail"];
    }
}
//Password error handling
if (isset($_POST["signupPassword"])) {
    if (empty ($_POST["signupPassword"])) {
        $signupPasswordError = $errorClass;
    } else {
        $signupPassword = $_POST["signupPassword"];
    }
}




//checking if signupEmail and signupPassword have been posted
if (isset($_POST["signupEmail"]) && isset($_POST["signupPassword"]))
    //&& strlen($_POST['signupPassword']>=5
{

    if (!empty($_POST['signupEmail']) && !empty($_POST['signupPassword']))
    {


        //client registration - only e-mail and passhash are registered.
        if($_POST['role_choice']=='client'){

            $result = $clientAuth->registerRequest($url,$_POST['signupEmail'],$_POST['signupPassword'],"0","0",$_POST['role_choice']);
            $response = json_decode($result);
            if ($response->status=="success") {
                header("location: signup_success.php");
                exit();
            } else {
                var_dump($_POST);
                //client registration error handling here
                if($response->status == 'error'){
                    // client already exists? Message accessible as string in $response->response
                }
            }

            //employe* registration
        } elseif ($_POST['role_choice'] == 'employee' or $_POST['role_choice'] == 'employer') {

                if (empty ($_POST["firstname"]) or  empty($_POST["lastname"])) {
                    $error = true;
                }

                if (empty ($_POST["phone"])) {
                    $error = true;
                }

                if (empty ($_POST["phone"])) {
                    $error = true;
                }

                if ($error = false) {
                    $signupEmail = $_POST["signupEmail"];
                    $signupPassword = $_POST["signuppasword"];
                    $name = $_POST['firstname'].'_'.$_POST['lastname'];
                    $phone = $_POST["phone"];
                    $result = $clientAuth->registerRequest($url, $_POST['signupEmail'], $_POST['signupPassword'], $_POST['phone'], $name, $_POST['role_choice']);
                    $response = json_decode($result);

                    if ($response->status == "success") {
                        header("location: signup_success.php");
                        exit();
                    } if($response->status == 'error'){
                    $errorMessage = "Email already registered!";
                    }

        } else {

                    $errorMessage = "Please fill all fields";


            }


        }
    }

}


    echo($errorMessage)

?>


<?php require("header.php"); ?>


    <div class="signup">
        <form method="POST" class="signup__form">

            <select id='sel-role' name="role_choice" class="form__field">
                <option value="client" <?=$sel_client?>>Client</option>
                <option value="employee" <?=$sel_employee?>>Employee</option>
                <option value="employer" <?=$sel_employer?>>Employer</option>
            </select>
            <input id='sel-phone' type="text" placeholder="phone number" name="phone" value="" class="form__field <?=$phoneError ?>">
            <input id='sel-email' type="email" placeholder="your e-mail address" name="signupEmail" value="<?=$signupEmail?>" class="form__field <?=$signupEmailError ?>">
            <input id='sel-fName' type="text" placeholder="first name" name="firstname" value="" class="form__field <?=$nameError ?>">
            <input id='sel-lName' type="text" placeholder="last name" name="lastname" value="" class="form__field <?=$nameError ?>">
            <input id='sel-pass' type="password" name="signupPassword" placeholder="password" class="form__field <?=$signupPasswordError ?>">
            <input id='sel-register' type="submit" value="sign up" class="form__button">
        </form>

    </div>
    <script src="js/login-reg.js"></script>

<?php require("footer.php"); ?>