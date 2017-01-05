<?php
$employeeName = "Obossum";
$compImgUrl = "http://i4.mirror.co.uk/incoming/article6221356.ece/ALTERNATES/s615b/MAIN-Angry-Seagull.jpg";
$employeeId = 4;
$companyDesciption = "";
$companyOpen = "";


?>


<?php require("header.php"); ?>


<div class="employee">
    <h2>Hello <?php echo $employeeName; ?>!</h2>

    <!-- <form method="POST" class="signup__form"> -->
    <form method="POST" class="employee__profile" enctype="multipart/form-data">
            <label class="upload__btn">
 		    	<img src=<?=$compImgUrl ?> class="employee-image">
  		    	<input type="file"name="fileToUpload" id="fileToUpload"/>
			</label>
        <input class="form__field "type="text" name="company-name" placeholder="What is your comany name?">
        <input class="form__field "type="text" name="company-address" placeholder="What is your comany address?">
        <textarea name="empDesciption" placeholder="Hello! This is one sentence about us. Read it and replace it with another one."><?php echo $companyDesciption;?></textarea>
        <textarea name="empDesciption" placeholder="Mo—Fri 10—20; Sa—Su 10—00"><?php echo $companyOpen;?></textarea>
        <input type="submit" value="submit" class="form__button" name="submit">
    </form>

</div>
</div>

<?php require("footer.php"); ?>


