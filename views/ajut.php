
<?php

    session_start();
    if($_SESSION['userRole'] != "employee"){
        header("location: index.php");
        exit();
    }

    require ('class/employeeView.class.php');
    require ('class/sliderBar.class.php');

    //session checks and stuff instead of true. Dummy data:
    $employeeId = $_SESSION['userId'];
    $apikey = $_SESSION['apiKey'];

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


<?php include ("header.php") ?>
<link rel="stylesheet" href="css/feedback.css" type="text/css">

<div class="employee">
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
        <a href="emp_welcome.php" class="feedback__nav-btn">Go back</a>
        <button class="feedback__nav-btn" id="info" value="What's this?"> What's this?</button>
    </nav>
</div>
<script src="js/employeeAnalysis.js"></script>
<?php require("footer.php"); ?>

