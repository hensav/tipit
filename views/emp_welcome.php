<?php
 	$employeeName = "Mariann";
    $employeeImgUrl = "http://i4.mirror.co.uk/incoming/article6221356.ece/ALTERNATES/s615b/MAIN-Angry-Seagull.jpg";
    $employeeId = 4;
	$empDesciption = "";


?>


<?php require("header.php"); ?>


    <div class="employee">
        <h2>Hello <?php echo $employeeName; ?>!</h2>

        <form action="upload.php" method="POST" class="signup__form" enctype="multipart/form-data">
            <label class="upload__btn">
 		    <img src=<?=$employeeImgUrl ?> class="employee-image">
  		    <input type="file"name="fileToUpload" id="fileToUpload"/>
			</label>

 			<textarea name="empDesciption" placeholder="Hello! This is my good thought of a day. Read it and replace it with yours."><?php echo $empDesciption;?></textarea>
 			 <input type="submit" value="save" class="form__button" name="submit">
 		</form>
       

    </div>
</div>

<?php require("footer.php"); ?>


