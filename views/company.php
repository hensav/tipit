<?php

session_start();
require("class/compWelcome.class.php");

$employeeId = $_SESSION['userId'];
$apikey = $_SESSION['apiKey'];





//dummydata
$trading_name = "";
$photo_url = "";
$description = "";
$opening_hours = "";
$address = "";

?>

<?php require("header.php"); ?>
<div class="employee">
	<h2><?php echo $companyName; ?></h2>
	<div class="company__profile">   
	    <img src=<?=$companyImgUrl?> class="employee-image">
	    <div class="container__companyAddress">
	    	<div class="addressPin"><img src="../uploads/emp_thumbnail.png" class="employeeThumbnail"></div>
	    	<div class="address"><p class="companyAddress"><?php echo $companyAddress;?></p></div>
	    </div>
	    <div class="container__companyAddress">
	    	<div class="addressPin"></div>
	    	<div class="address"><p><?php echo $companyOpen; ?></p></div>
	    </div>
    </div>
	    <p class="companyDescription"><?php echo $companyDescription; ?></p>
	</div>
    <div class="container__employee">
	    <div class="employeeThumbnail"><img src="../uploads/emp_thumbnail.png" class="employeeThumbnail"></div>
	    <div class="employeeName"><?php echo $employeeName;?></div>
	    <div class="employeeRating"><?php echo $employeeRating;?></div>
	</div>
	<div class="container__employee">
	    <div class="employeeThumbnail"><img src="../uploads/emp_thumbnail.png" class="employeeThumbnail"></div>
	    <div class="employeeName"><?php echo $employeeName;?></div>
	    <div class="employeeRating"><?php echo $employeeRating;?></div>
	</div>
</div>


<?php require("footer.php"); ?>