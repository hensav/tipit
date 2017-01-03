<?php

require("class/UploadTools.class.php");
require("class/employeeView.class.php");

    //start of test data
    $employeeId = 10;
    $apikey = 123;
    //End of test data. The above will be replaced with employee id and apikey from session once login is properly implemented.

    $defaultDescr = "";

    if(isset($_POST['submit'])){
        $description = null;
        $fileName = null;
        if(isset($_FILES)){
            $uploadAttempt = UploadTools::uploadImage($_FILES);
            if($uploadAttempt['errorCode']==false){
                $fileName = $uploadAttempt["message"];
            }
        }
        if(isset($_POST['empDescription'])){
            $description = $_POST['empDescription'];
        }
        $response = employeeView::updateDetails($description,$fileName,$employeeId,$apikey);
    }

    $rawData = employeeView::getDetails($employeeId,$apikey);
    $imgRoot = "http://naturaalmajand.us/tipit/uploads/";

 	$employeeName = explode("_",$rawData->name)[0];
    $employeeImgUrl = $imgRoot.$rawData->photo_url;
	if(strlen($rawData->description)>3){
	    $employeeDescription = $rawData->description;
    } else {
	    $employeeDescription = $defaultDescr;
    }

?>


<?php require("header.php"); ?>


    <div class="employee">
        <h2>Hello <?php echo $employeeName; ?>!</h2>

        <form method="POST" class="signup__form" enctype="multipart/form-data">
            <label class="upload__btn">
 		    	<img src=<?=$employeeImgUrl ?> class="employee-image">
  		    	<input type="file"name="fileToUpload" id="fileToUpload"/>
			</label>
 			<textarea id="descriptionArea" name="empDescription" placeholder="Hello! This is my good thought of a day. Read it and replace it with yours.">
                <?php if(!empty($employeeId)){echo $employeeDescription;} ?>
            </textarea>
 			 <input type="submit" value="submit" class="form__button" name="submit">
  		</form>
       <p class="employee--good-code txt-center">This is My Good Code:</p>
       <p class="good-code txt-center">Ma54r8</p>
    </div>
</div>
<script>
    $(document).ready(function(){
       $("#descriptionArea").click(function(){
           $("#descriptionArea").val('');
       })
    });
</script>

<?php require("footer.php"); ?>


