<?php  

session_start();
if($_SESSION['userRole'] != "employee"){
    header("location: index.php");
    exit();
}

require("class/UploadTools.class.php");
require("class/employeeView.class.php");
require ('class/sliderBar.class.php');

$employeeId = $_SESSION['userId'];
$apikey = $_SESSION['apiKey'];
$defaultDescr = "";

if(isset($_POST['submit'])){
    $description = null;
    $fileName = null;
    if(isset($_FILES)){
        $uploadAttempt = UploadTools::uploadImage($_FILES);
        if($uploadAttempt['errorCode']==false){
            $fileName = $uploadAttempt["message"];
        }
    }
    if(isset($_POST['empDescription'])){
        $description = $_POST['empDescription'];
    }
    $response = employeeView::updateDetails($description,$fileName,$employeeId,$apikey);
}

$rawData = employeeView::getDetails($employeeId,$apikey);
$imgRoot = "http://naturaalmajand.us/tipit/uploads/";
$requestHtml = "";
$requests = employeeView::getPendingRequests($employeeId,$apikey);

if($requests->status == 'success'){
    if(isset($_POST['response'])){
        if($_POST['response'] =="Confirm"){
            $responseSent = employeeView::respondToRequest($employeeId,$_POST['requestId'],"Accept",$apikey);
            $requestHtml = "<div class='request__wrapper'><span class='request__alert'>Request accepted!</span></div>";
        } elseif ($_POST['response'] =="Reject"){
            $responseSent = employeeView::respondToRequest($employeeId,$_POST['requestId'],$_POST['response'],$apikey);
            $requestHtml = "<div class='request__wrapper'><span class='request__alert'>Request rejected!</span></div>";
        }
    } else {

        foreach ($requests->content as $content){
            $requestHtml .= "
            <div class='request__wrapper'>
            <span class='request__alert'> $content->trading_name has marked you as an employee.</span>
            <form method='post' class='request__wrapper--button-margin'>
            <input class='href__button' type='submit' name='response' value='Confirm'>
            <input class='href__button' type='submit' name='response' value='Reject'>
            <input type='hidden' name='requestId' value='$content->requestId'>
            </form>
            </div>
            
            ";
        }
    }
}

$employeeName = explode("_",$rawData->name)[0];
$goodcode = $rawData->goodcode;
if(strlen($rawData->photo_url)>3) {
    $employeeImgUrl = $imgRoot . $rawData->photo_url;
} else {
    $employeeImgUrl = $imgRoot . "emp_placehold.jpg";
}
if(strlen($rawData->description)>3){
    $employeeDescription = $rawData->description;
} else {
    $employeeDescription = $defaultDescr;
}

if(true){
    /** Count and profit **/
    $shortStats = json_decode(employeeView::fetchStats($employeeId,$apikey));

    if(isset($shortStats[0]->ratingCount)){
        $ratingCount = $shortStats[0]->ratingCount;
    } else {
        $ratingCount = 0;
    }

    if(isset($shortStats[0]->earnings) && $shortStats[0]->earnings != NULL){
        $earnings = $shortStats[0]->earnings;
    } else {
        $earnings = 0;
    }

/** Sliders **/
$rawSliderData = json_decode(employeeView::fetchSliderData($employeeId,$apikey));
$current = array();
$previous = array();
$totalBar = new sliderBar(array(
    "name"=>"Total",
    "current" => round(($rawSliderData[0]->total)*20,0),
    "previous" => round(($rawSliderData[1]->total)*20,0)
    ));
$quickBar = new sliderBar(array(
    "name"=>"Super-quick",
    "current" => round(($rawSliderData[0]->P1)*20,0),
    "previous" => round(($rawSliderData[1]->P1)*20,0)
    ));
$punctualBar = new sliderBar(array(
    "name"=>"Punctual",
    "current" => round(($rawSliderData[0]->P2)*20,0),
    "previous" => round(($rawSliderData[1]->P2)*20,0)
    ));
$helpfulBar = new sliderBar(array(
    "name"=>"Helpful",
    "current" => round(($rawSliderData[0]->P3)*20,0),
    "previous" => round(($rawSliderData[1]->P3)*20,0)
    ));
}

?>

<?php require("header.php"); ?>
<link rel="stylesheet" href="css/feedback.css" type="text/css">

    <div class="employee">
        <h2><?php echo $employeeName; ?></h2>
        <?php echo $requestHtml; ?>

        <h2>Weekly overview</h2>

        <p class="feedback">Feedback: <?php echo $ratingCount;?><br>Compliments: <?php echo $earnings;?> €</p>
        <?php
        $totalBar->displaySlider();
        $quickBar->displaySlider();
        $punctualBar->displaySlider();
        $helpfulBar->displaySlider();
        ?>

        <nav class="feedback__nav">
            <div class="feedback__popdown" id="popdown">
                Here you can see how you've performed this week, compared to how well you did last week.
                More granular feedback will be implemented in the future.
            </div>
            <h2><class="txt-center" id="info" value="What's this?">What's this?</></h2>
        </nav>
            <br>
            <a href="emp_welcome.php" class="feedback__nav-btn">Edit Profile</a>
    </div>

<script src="js/employeeAnalysis.js"></script>
<?php require("footer.php"); ?>
