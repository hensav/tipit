<?php
 	$employeeName = "Mariann";
    $employeeImgUrl = "http://i4.mirror.co.uk/incoming/article6221356.ece/ALTERNATES/s615b/MAIN-Angry-Seagull.jpg";
    $employeeId = 4;
	$empDesciption = "";


$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>


<?php require("header.php"); ?>


    <div class="employee">
        <h2>Hello <?php echo $employeeName; ?>!</h2>
       

      




        <form method="POST" class="signup__form">
            <label class="upload__btn">
 		    <img src=<?=$employeeImgUrl ?> class="employee-image">
  		    <input type="file"name="fileToUpload" id="fileToUpload"/>
			</label>

 			<textarea name="empDesciption" placeholder="Hello! This is my good thought of a day. Read it and replace it with yours."><?php echo $empDesciption;?></textarea>
 			 <input type="submit" value="save" class="form__button">
 		</form>
       

    </div>
</div>

<?php require("footer.php"); ?>


