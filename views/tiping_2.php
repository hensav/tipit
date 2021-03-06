<?php

    session_start();
    if ($_SESSION['userRole'] != "client") {
        header("location: index.php");
        exit();
    }

    $clientId = $_SESSION['userId'];
    $apikey = $_SESSION['apiKey'];
    $ratingError = "";

    if (isset($_POST['mainRating']) or (isset($_POST['quickRating'])
            && isset($_POST['punctualRating']) && isset($_POST['helpfulRating']))) {
        require("class/clientView.class.php");

        if (empty($_POST['quickRating'])) {
            $_POST['quickRating'] = $_POST['mainRating'];
        }

        if (empty($_POST['punctualRating'])) {
            $_POST['punctualRating'] = $_POST['mainRating'];
        }

        if (empty($_POST['helpfulRating'])) {
            $_POST['helpfulRating'] = $_POST['mainRating'];
        }

        $leaveRating = clientView::rateEmployee($apikey,$_GET['employeeId'],$clientId,$_POST['quickRating'],$_POST['punctualRating'],$_POST['helpfulRating']);

        if ($leaveRating->status != "success") {
            $ratingError = $leaveRating->msg;
        } else {
            require('class/companyPage.class.php');
            $result = company_page::fetchCompanyByEmployee($_GET['employeeId'],$apikey);
            if (isset($result[0]->company_id)) {
                $cId = $result[0]->company_id;
                header("location: thankyou.php?C=$cId");
            } else {
                header("location: thankyou.php");
            }
            exit();
        }
    } elseif (!empty($_POST)) {
            $ratingError = 'Rating not left - please either leave three separate grades or a main evaluation';
    }

    $apikey = 123;
    $imgRoot = "http://naturaalmajand.us/tipit/uploads/";

    //get employee id, name and image url from db based on goodcode passed from prev. page. Dummy data:
   if (isset($_GET['employeeId'])) {

        require ('class/clientView.class.php');

        $raw = clientView::fetchEmployeeData(htmlspecialchars(stripslashes($_GET['employeeId'])),$apikey);
        if ($raw == "false") {
            header("location: tiping.php");
        }

        $results = json_decode($raw);
        $employeeName = (explode("_",$results->name))[0];
        $employeeImgFilename = $results->photo_url;
        if (strlen($employeeImgFilename)<10) {
            $employeeImgFilename = "default.png";
        }
        $employeeImgUrl = $imgRoot.$employeeImgFilename;

   } else {
      // header("location: tiping.php");
   }

     require("header.php"); ?>
<div class="employee">

    <h2><?php echo $employeeName; ?></h2>
    <section class="mainRating">
    <img src=<?=$employeeImgUrl ?> class="employee-image">

    <form method="post">
        <fieldset class="rating">
            <legend></legend>
            <input type="radio" id="mStar1" name="mainRating" value="5" /><label for="mStar1" title="Rocks!"><i class="fa fa-star" aria-hidden="true"></i></label>
            <input type="radio" id="mStar2" name="mainRating" value="4" /><label for="mStar2" title="Pretty good"><i class="fa fa-star" aria-hidden="true"></i></label>
            <input type="radio" id="mStar3" name="mainRating" value="3" /><label for="mStar3" title="Meh"><i class="fa fa-star" aria-hidden="true"></i></label>
            <input type="radio" id="mStar4" name="mainRating" value="2" /><label for="mStar4" title="Kinda bad"><i class="fa fa-star" aria-hidden="true"></i></label>
            <input type="radio" id="mStar5" name="mainRating" value="1" /><label for="mStar5" title="Socks big time"><i class="fa fa-star" aria-hidden="true"></i></label>
        </fieldset>
    </section>
    <div class="granular-wrapper">
        <header class="granular-rating-title">More options<i aria-hidden="true"> </i>
        </header>
        <section class="granular-rating-body">

            <span class="fieldset-title">Super-quick</span>
            <fieldset class="rating">
                <legend></legend>
                <input type="radio" id="qStar1" name="quickRating" value="5" /><label for="qStar1" title="Rocks!"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="qStar2" name="quickRating" value="4" /><label for="qStar2" title="Pretty good"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="qStar3" name="quickRating" value="3" /><label for="qStar3" title="Meh"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="qStar4" name="quickRating" value="2" /><label for="qStar4" title="Kinda bad"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="qStar5" name="quickRating" value="1" /><label for="qStar5" title="Socks big time"><i class="fa fa-star" aria-hidden="true"></i></label>
            </fieldset>

            <span class="fieldset-title">Punctual</span>
            <fieldset class="rating">
                <legend></legend>
                <input type="radio" id="pStar1" name="punctualRating" value="5" /><label for="pStar1" title="Rocks!"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="pStar2" name="punctualRating" value="4" /><label for="pStar2" title="Pretty good"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="pStar3" name="punctualRating" value="3" /><label for="pStar3" title="Meh"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="pStar4" name="punctualRating" value="2" /><label for="pStar4" title="Kinda bad"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="pStar5" name="punctualRating" value="1" /><label for="pStar5" title="Socks big time"><i class="fa fa-star" aria-hidden="true"></i></label>
            </fieldset>

            <span class="fieldset-title">Helpful</span>
            <fieldset class="rating">
                <legend></legend>
                <input type="radio" id="hStar1" name="helpfulRating" value="5" /><label for="hStar1" title="Rocks!"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="hStar2" name="helpfulRating" value="4" /><label for="hStar2" title="Pretty good"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="hStar3" name="helpfulRating" value="3" /><label for="hStar3" title="Meh"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="hStar4" name="helpfulRating" value="2" /><label for="hStar4" title="Kinda bad"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="hStar5" name="helpfulRating" value="1" /><label for="hStar5" title="Socks big time"><i class="fa fa-star" aria-hidden="true"></i></label>
            </fieldset>

        </section>
    </div>
    <input type="hidden" name="employeeId" value=<?=$employeeId?>>
    <span class="error"><?php echo $ratingError; ?></span>
    <input type="submit" class="href__button" value="Feedback"/>
    </form>
    <div class="w3-container">
        <div class="w3-progress-container">
            <div class="w3-progressbar" style="width:50%"></div>
        </div>
    </div>

</div>
<script src="js/ratingPage.js" type="text/javascript"></script>


<?php require("footer.php"); ?>