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
if (isset($_POST["signupEmail"]) && isset($_POST["signupPassword"])){
    //replacing empty (non-obligatory) fields with empty strings to avoid api url bugs
    if(empty($_POST['phone'])){
        $regPhone='';
    } else {
        $regPhone=$_POST['phone'];
    }
    //Same as above + concatenating first- and last name as URL doesn't tolerate whitespace
    $name = $_POST['firstname'].'_'.$_POST['lastname'];
    if($name=='_'){
        $name = '';
    }
    $result = $clientAuth->registerRequest($url,$_POST['signupEmail'],$_POST['signupPassword'],$regPhone,$name,$_POST['role_choice']);
    var_dump($result);
}
?>


<?php require("header.php"); ?> 


<div class="signup">
    <form method="POST" class="signup__form">
        
        <select id='sel-role' name="role_choice" class="form__field">
                <option value="client">Client</option>
                <option value="employee">Employee</option>
                <option value="employer">Employer</option>
        </select>
        <input id='sel-phone' type="text" placeholder="phone number" name="phone" value="" class="form__field field--optional">
        <input id='sel-email' type="email" placeholder="your e-mail address" name="signupEmail" value="<?=$signupEmail?>" class="form__field <?=$signupEmailError ?>">
        <input id='sel-fName' type="text" placeholder="first name" name="firstname" value="" class="form__field field--optional">
        <input id='sel-lName' type="text" placeholder="last name" name="lastname" value="" class="form__field field--optional">
        <input id='sel-pass' type="password" name="signupPassword" placeholder="password" class="form__field <?=$signupPasswordError ?>">
        <input id='sel-register' type="submit" value="sign up" class="form__button">
    </form>

    </div>
</div>
<script src="js/login-reg.js"></script>

<?php require("footer.php"); ?>
