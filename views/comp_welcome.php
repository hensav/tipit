<?php
session_start();
if($_SESSION['userRole'] != "employer"){
    header("location: index.php");
    exit();

}
require('class/compWelcome.class.php');


$employerId = $_SESSION['userId'];
$apikey = $_SESSION['apiKey'];
$rawData = compWelcome::getEmployer($apikey,$employerId);
$imgRoot = "http://naturaalmajand.us/tipit/uploads/";

$employerName = explode("_",$rawData->name)[0];



$related_user = $_SESSION['userId'];
$trading_name = "";
$email = "";
$address = "";
$description = "";
$opening_hours = "";
$photo_url = "";


if (isset($_POST["trading_name"]) && isset($_POST["email"]) && isset($_POST["address"]) && isset($_POST["description"])
    && isset($_POST["opening_hours"])){

    //kliendi class->f.nimi
    $result = $compWelcome->addDetails($apikey,$related_user,$_POST['trading_name'],$_POST['email'],$_POST['address'],$_POST['description'],$_POST['opening_hours']);
    $response = json_decode($result);

}
echo($apikey)
?>



<?php require("header.php"); ?>


<div class="employee">
    <h2>Hello <?php echo $employerName; ?>!</h2>

    <!-- <form method="POST" class="signup__form"> -->
    <form method="POST" class="employee__profile" enctype="multipart/form-data">

        <input class="form__field "type="text" name="company-name" placeholder="What is your comany name?" value="<?=$trading_name?>">
        <input class="form__field "type="text" name="company-address" placeholder="What is your comany address?" value="<?=$address?>">
        <input class="form__field "type="text" name="company-email" placeholder="What's your company's email?" value="<?=$email?>">
        <input class="form__field "type="text" name="company-opening" placeholder="What time are you open?" value="<?=$opening_hours?>">
         <textarea name="empDesciption" placeholder="Hello! This is one sentence about us. Read it and replace it with another one." value="<?=$description?>"></textarea>
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


