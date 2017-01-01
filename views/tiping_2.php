<?php
    if(isset($_POST['mainRating']) or (isset($_POST['quickRating'])&&isset($_POST['punctualRating'])&&isset($_POST['helpfulRating']))){

        //require rating class, make DB entry based on 1 or 3 parameters above, employee id from $_POST
        header('location: thankyou.php');
                exit();
    }



    //get employee id, name and image url from db based on goodcode passed from prev. page. Dummy data:
    $employeeName = "Mariann";
    $employeeImgUrl = "http://i4.mirror.co.uk/incoming/article6221356.ece/ALTERNATES/s615b/MAIN-Angry-Seagull.jpg";
    $employeeId = 4;

     require("header.php"); ?>
<div class="employee">

    <h2><?php echo $employeeName; ?></h2>
    <section class="mainRating">
    <img src=<?=$employeeImgUrl ?> class="employee-image">

    <form method="post">
    <fieldset class="rating">
        <legend></legend>
        <input type="radio" id="star1" name="mainRating" value="1" /><label for="star1" title="Rocks!"><i class="fa fa-star" aria-hidden="true"></i></label>
        <input type="radio" id="star2" name="mainRating" value="2" /><label for="star2" title="Pretty good"><i class="fa fa-star" aria-hidden="true"></i></label>
        <input type="radio" id="star3" name="mainRating" value="3" /><label for="star3" title="Meh"><i class="fa fa-star" aria-hidden="true"></i></label>
        <input type="radio" id="star4" name="mainRating" value="4" /><label for="star4" title="Kinda bad"><i class="fa fa-star" aria-hidden="true"></i></label>
        <input type="radio" id="star5" name="mainRating " value="5" /><label for="star5" title="Socks big time"><i class="fa fa-star" aria-hidden="true"></i></label>
    </fieldset>
    </section>
    <div class="granular-wrapper">
        <header class="granular-rating-title">More options <i class="fa fa-chevron-down" aria-hidden="true"> </i>
        </header>
        <section class="granular-rating-body">

            <span class="fieldset-title">Super-quick</span>
            <fieldset class="rating">
                <legend></legend>
                <input type="radio" id="qStar1" name="quickRating" value="1" /><label for="qStar1" title="Rocks!"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="qStar2" name="quickRating" value="2" /><label for="qStar2" title="Pretty good"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="qStar3" name="quickRating" value="3" /><label for="qStar3" title="Meh"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="qStar4" name="quickRating" value="4" /><label for="qStar4" title="Kinda bad"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="qStar5" name="quickRating" value="5" /><label for="qStar5" title="Socks big time"><i class="fa fa-star" aria-hidden="true"></i></label>
            </fieldset>

            <span class="fieldset-title">Punctual</span>
            <fieldset class="rating">
                <legend></legend>
                <input type="radio" id="pStar1" name="punctualRating" value="1" /><label for="pStar1" title="Rocks!"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="pStar2" name="punctualRating" value="2" /><label for="pStar2" title="Pretty good"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="pStar3" name="punctualRating" value="3" /><label for="pStar3" title="Meh"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="pStar4" name="punctualRating" value="4" /><label for="pStar4" title="Kinda bad"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="pStar5" name="punctualRating" value="5" /><label for="pStar5" title="Socks big time"><i class="fa fa-star" aria-hidden="true"></i></label>
            </fieldset>

            <span class="fieldset-title">Helpful</span>
            <fieldset class="rating">
                <legend></legend>
                <input type="radio" id="hStar1" name="helpfulRating" value="1" /><label for="hStar1" title="Rocks!"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="hStar2" name="helpfulRating" value="2" /><label for="hStar2" title="Pretty good"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="hStar3" name="helpfulRating" value="3" /><label for="hStar3" title="Meh"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="hStar4" name="helpfulRating" value="4" /><label for="hStar4" title="Kinda bad"><i class="fa fa-star" aria-hidden="true"></i></label>
                <input type="radio" id="hStar5" name="helpfulRating" value="5" /><label for="hStar5" title="Socks big time"><i class="fa fa-star" aria-hidden="true"></i></label>
            </fieldset>

        </section>
    </div>
    <input type="hidden" name="employeeId" value=<?=$employeeId?>>
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