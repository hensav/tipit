<?php
//dummydata
$companyName = "Lendav Taldrik";
$companyImgUrl = "http://www.northestonia.eu/sites/default/files/styles/large/public/visitestonia_pics/d0b4f1cdca0e3e3aadc1bf3eab9029ba.jpg?itok=4PnXFqtH";
$companyDescription = "Me ei ole tüüpiline Aasia restoran. Tule ja vaata, milles kogu kära!";
$companyOpen = "Mo—Fri 10—20; Sa—Su 10—00";
$companyAddress = "Toomrüütli 666, Tallinn";

$companyKind = "Restoran";
$companyName = "Toompea Tina";
$employeeName = "Jüri Vokiratas";
$employeeRating = "3.6";
$companyRating = "0.6";
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
	    	<div class="addressPin"><img src="../uploads/emp_thumbnail.png" class="employeeThumbnail"></div>
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