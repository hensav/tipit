<?php
session_start();
if($_SESSION['userRole'] != "employer"){
    header("location: index.php");
    exit();

}
require('class/compWelcome.class.php');
require("class/UploadTools.class.php");


    $employerId = $_SESSION['userId'];
    $apikey = $_SESSION['apiKey'];

    $defaultDescr = "";

if(isset($_POST['submit'])){
    $description = null;
    $fileName = null;
    $trading_name = null;
    $email = null;
    $address = null;
    $description = null;
    $opening_hours = null;
    if(isset($_FILES)){
        $uploadAttempt = UploadTools::uploadImage($_FILES);
        if($uploadAttempt['errorCode']==false){
            $fileName = $uploadAttempt["message"];
        }
    }
    if(isset($_POST['description'])){
        $description = $_POST['description'];
    }
    if(isset($_POST['trading_name'])){
        $trading_name = $_POST['trading_name'];
    }
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }
    if(isset($_POST['address'])){
        $address = $_POST['address'];
    }
    if(isset($_POST['opening_hours'])){
        $opening_hours = $_POST['opening_hours'];
    }
    $response = compWelcome::updateDetails($description,$fileName,$employerId,$apikey,$trading_name,$email,$address,$opening_hours);
}

$rawData1 = compWelcome::getEmployer($apikey,$employerId);
$rawData = compWelcome::fetchCompanyView($apikey,$employerId);

$imgRoot = "http://naturaalmajand.us/tipit/uploads/";

$employerName = explode("_",$rawData1->name)[0];



$related_user = $_SESSION['userId'];
$trading_name = "";
$email = "";
$address = "";
$description = "";
$opening_hours = "";
$photo_url = "";








if(strlen($rawData->photo_url)>3) {
    $compImgUrl = $imgRoot . $rawData->photo_url;
} else {
    $compImgUrl = $imgRoot . "emp_placehold.jpg";
}
if(strlen($rawData->description)>3){
    $employeeDescription = $rawData->description;
} else {
    $employeeDescription = $defaultDescr;
}
?>



<?php require("header.php"); ?>


<div class="employee">
    <h2>Hello <?php echo $employerName; ?>!</h2>

    <!-- <form method="POST" class="signup__form"> -->
    <form method="POST" class="employee__profile" enctype="multipart/form-data">

        <label class="upload__btn">
            <img src=<?=$compImgUrl ?> class="employee-image">
            <input type="file"name="fileToUpload" id="fileToUpload"/>
        </label>

        <input class="form__field "type="text" name="company-name" placeholder="What is your comany name?" value="<?=$trading_name?>">
        <input class="form__field "type="text" name="company-address" placeholder="What is your comany address?" value="<?=$address?>">
        <textarea name="empDesciption" placeholder="Hello! This is one sentence about us. Read it and replace it with another one." value="<?=$description?>"></textarea>
        <input class="form__field "type="text" name="company-email" placeholder="What's your company's email?" value="<?=$email?>">
        <input class="form__field "type="text" name="company-opening" placeholder="What time are you open?" value="<?=$opening_hours?>">
        <!--
        <label class="upload__btn">
            <img src=<?//=$compImgUrl ?> class="employee-image">
            <input type="file"name="fileToUpload" id="fileToUpload"/>
        </label>
         -->
        <input type="submit" value="submit" class="form__button" name="submit">
    </form>

</div>

<?php require("footer.php"); ?>


