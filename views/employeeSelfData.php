<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    require ('class/employeeView.class.php');
    require ('class/sliderBar.class.php');
    //session checks and stuff instead of true. Currently hardcoding employee id and apikey
    if(true){
        $employeeId = 10;
        $apikey = 123;
        $rawSliderData = json_decode(employeeView::fetchSliderData($employeeId,$apikey));
        $current = array();
        $previous = array();
        $totalBar = new sliderBar(array(
            "name"=>"Total",
            "current" => ($rawSliderData[0]->total)*100/5,
            "previous" => ($rawSliderData[1]->total)*100/5
        ));
        $quickBar = new sliderBar(array(
            "name"=>"Super-quick",
            "current" => ($rawSliderData[0]->P1)*100/5,
            "previous" => ($rawSliderData[1]->P1)*100/5
        ));
        $punctualBar = new sliderBar(array(
            "name"=>"Punctual",
            "current" => ($rawSliderData[0]->P2)*100/5,
            "previous" => ($rawSliderData[1]->P2)*100/5
        ));
        $helpfulBar = new sliderBar(array(
            "name"=>"Helpful",
            "current" => ($rawSliderData[0]->P3)*100/5,
            "previous" => ($rawSliderData[1]->P3)*100/5
        ));
    }


    ?>
<html>
<head>
    <link rel="stylesheet" href="main.css" type="text/css"/>
    <link rel="stylesheet" href="css/sliderBar.css" type="text/css">
</head>
<body>
    <?php include ("header.php") ?>

    Some text here. Go you!
    <?php
        $totalBar->displaySlider();
        $quickBar->displaySlider();
        $punctualBar->displaySlider();
        $helpfulBar->displaySlider();


    ?>
    <?php require("footer.php"); ?>

</body>
</html>
