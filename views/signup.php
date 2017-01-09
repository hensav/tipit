<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$url = "http://naturaalmajand.us/tipit/api/request.php/";
require("./class/clientAuth.class.php");
$clientAuth = new clientAuth;
$signupEmail = "";
$signupPassword = "";
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


if (isset($_POST["submit"])) {

    if ($_POST['role_choice']=='client'){

        if (isset($_POST["signupEmail"]) && isset($_POST["signupPassword"])){

            if (!empty ($_POST["signupEmail"]) &&  !empty($_POST["signupPassword"])) {

                if (strlen($_POST['signupPassword']) >=5){
                    $signupEmail = $_POST["signupEmail"];
                    $signupPassword = $_POST["signupPassword"];
                    $result = $clientAuth->registerRequest($url,$_POST['signupEmail'],$_POST['signupPassword'],"0","0",$_POST['role_choice']);
                    $response = json_decode($result);

                    if ($response->status == "success") {
                        header("location: signup_success.php");

                        exit();

                    } if ($response->status == 'error'){
                        $errorMessage = "Email already registered!";
                    }

                }else{
                    $errorMessage = "Please choose a password that is at least 6 characters long";
                }

            } else {

                $errorMessage = "Please fill all fields";
            }

        }

    } elseif ($_POST['role_choice'] == 'employee' or $_POST['role_choice'] == 'employer') {



        if (isset($_POST["signupEmail"]) && isset($_POST["signupPassword"])){

            if (!empty ($_POST["signupEmail"]) &&  !empty($_POST["signupPassword"]) && !empty ($_POST["firstname"])
                && !empty($_POST["lastname"]) && !empty ($_POST["phone"]) && !empty ($_POST["phone"])) {

                if (strlen($_POST['signupPassword']) >=5){

                $signupEmail = $_POST["signupEmail"];
                $signupPassword = $_POST["signupPassword"];
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

                }else{

                    $errorMessage = "Please choose a password that is at least 6 characters long";
                }

            } else {

                $errorMessage = "Please fill all fields";
            }
        }

    }
}

?>


<?php require("header.php"); ?>


    <div class="signup">
        <form method="POST" class="signup__form">

            <select id='sel-role' name="role_choice" class="form__field">
                <option value="client" <?=$sel_client?>>Client</option>
                <option value="employee" <?=$sel_employee?>>Employee</option>
                <option value="employer" <?=$sel_employer?>>Employer</option>
            </select>
            <input id='sel-phone' type="text" placeholder="phone number" name="phone" value="" class="form__field">
            <input id='sel-email' type="email" placeholder="your e-mail address" name="signupEmail" value="<?=$signupEmail?>" class="form__field ">
            <input id='sel-fName' type="text" placeholder="first name" name="firstname" value="" class="form__field">
            <input id='sel-lName' type="text" placeholder="last name" name="lastname" value="" class="form__field">
            <input id='sel-pass' type="password" name="signupPassword" placeholder="password" class="form__field">

            <?php echo($errorMessage); ?>

            <input id='sel-register' type="submit" name ="submit" value="sign up" class="form__button">
        </form>

    </div>
    <script src="js/login-reg.js"></script>

<?php require("footer.php"); ?>