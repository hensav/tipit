<?php
    session_start();
    if($_SESSION['userRole'] != "employee"){
        header("location: index.php");
        exit();
    }

require("class/UploadTools.class.php");
require("class/employeeView.class.php");


    $employeeId = $_SESSION['userId'];
    $apikey = $_SESSION['apiKey'];


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

    $requestHtml = "";
    $requests = employeeView::getPendingRequests($employeeId,$apikey);

    if($requests->status == 'success'){
        if(isset($_POST['response'])){
            if($_POST['response'] =="Accept"){
                $responseSent = employeeView::respondToRequest($employeeId,$_POST['requestId'],$_POST['response'],$apikey);
                $requestHtml = "<div class='request__wrapper'><span class='request__alert'>Request accepted!</span></div>";
            } elseif ($_POST['response'] =="Reject"){
                $responseSent = employeeView::respondToRequest($employeeId,$_POST['requestId'],$_POST['response'],$apikey);
                $requestHtml = "<div class='request__wrapper'><span class='request__alert'>Request rejected!</span></div>";
            }
        } else {

            foreach ($requests->content as $content){
                $requestHtml .= "
                <div class='request__wrapper'>
                <span class='request__alert'> $content->trading_name has marked you as an employee.</span>
                <form method='post'>
                <input type='submit' name='response' value='Accept'>
                <input type='submit' name='response' value='Reject'>
                <input type='hidden' name='requestId' value='$content->requestId'>
                </form>
                </div>
                
                ";
            }
        }
    }


 	$employeeName = explode("_",$rawData->name)[0];
 	$goodcode = $rawData->goodcode;
 	if(strlen($rawData->photo_url)>3) {
        $employeeImgUrl = $imgRoot . $rawData->photo_url;
    } else {
 	    $employeeImgUrl = $imgRoot . "emp_placehold.jpg";
    }
	if(strlen($rawData->description)>3){
	    $employeeDescription = $rawData->description;
    } else {
	    $employeeDescription = $defaultDescr;
    }

?>


<?php require("header.php"); ?>


    <div class="employee">
        <h2>Hello <?php echo $employeeName; ?>!</h2>
        <?php echo $requestHtml; ?>
        <a href="employeeSelfData.php">View your weekly statistics</a>
        <form method="POST" class="employee__profile" enctype="multipart/form-data">
            <label class="upload__btn">
 		    	<img src=<?=$employeeImgUrl ?> class="employee-image">
  		    	<input type="file"name="fileToUpload" id="fileToUpload"/>
			</label>
 			<textarea id="descriptionArea" name="empDescription" placeholder="Hello! This is my good thought of a day. Read it and replace it with yours."><?php if(!empty($employeeId)){echo trim($employeeDescription);} ?>
            </textarea>
 			 <input type="submit" value="submit" class="form__button" name="submit">
  		</form>
       <p class="employee--good-code txt-center">This is My Good Code:</p>
       <p class="good-code txt-center"><?=$goodcode?></p>
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


