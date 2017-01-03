<?php

$companyKind = "Restoran";
$companyName = "Toompea Tina";
$employeeName = "Jüri Vokiratas";
$employeeRating = "3.6";
$companyRating = "0.6";

?>

<?php include ("header.php") ?>

<div class="employee">

    <div class="companyKind"><?php echo $companyKind;?></div>
    <div class="container__company">
    <div class="companyName"><?php echo $companyName;?></div>
    <div class="companyRating"><?php echo $companyRating;?></div>
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