<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if($_SESSION['userRole'] != "employer"){
    header("location: index.php");
    exit();

}

require("class/UploadTools.class.php");
require('class/compWelcome.class.php');

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
    if(!empty($fileName)){
        $photo_url = $fileName;

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
    $response = compWelcome::addDetails($fileName,$_SESSION['apiKey'],$_SESSION['userId'],$trading_name,$email,$address,$description,$opening_hours);
    //var_dump($response);
    if($response->status == "success"){
        header('location: manageWorkforce.php');
         exit();
    }
    

}


$employerRawData = compWelcome::getEmployer($apikey,$employerId);
$rawData = compWelcome::fetchCompanyView($apikey,$employerId);
$imgRoot = "http://naturaalmajand.us/tipit/uploads/";
$employerName = explode("_",$employerRawData->name)[0];
$related_user = $_SESSION['userId'];
//var_dump($rawData);

if(strlen($rawData->photo_url)>3) {
    $compImgUrl = $imgRoot . $rawData->photo_url;
} else {
    $compImgUrl = $imgRoot . "emp_placehold.jpg";
}
if(strlen($rawData->description)>3){
    $employeeDescription = $rawData->description;

}

?>




<?php require("header.php"); ?>


<div class="employee">
    <h2>Hello <?php echo $employerName; ?>!</h2>

    <form method="POST" class="employee__profile" enctype="multipart/form-data">

        <label class="upload__btn">
            <img src=<?=$compImgUrl ?> class="employee-image">
            <input type="file"name="fileToUpload" id="fileToUpload"/>
        </label>

        <input class="form__field "type="text" name="trading_name" placeholder="What is your company name?" value="">
        <input class="form__field "type="text" name="address" placeholder="What is your company address?" value="">
        <textarea name="description " placeholder="Hello! This is one sentence about us. Read it and replace it with another one." value=""></textarea>
        <input class="form__field "type="text" name="email" placeholder="What's your company's email?" value="">
        <input class="form__field "type="text" name="opening_hours" placeholder="What time are you open?" value="">
      
    <input type="submit" value="submit" class="form__button" name="submit">
</form>

</div>

<?php require("footer.php"); ?>


