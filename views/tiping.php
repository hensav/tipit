<?php

require("class/clientView.class.php");

$goodCode = "";
$goodCodeError = ""; 
$class = "";

if (isset ($_POST["goodCode"]) && !empty ($_POST["goodCode"])) {
    $result = clientView::fetchEmployeeByGoodcode($_POST['goodCode'],$apikey);

    if($result->status=="success"){
        $id = $result->msg;

        header("location: tiping_2.php?employeeId=$id");
    }
}



?>


<?php require("header.php"); ?>


    <div class="employee">
        <form method="post" class="employee__auth">
            <input type="text" placeholder="The good code" name="goodCode" value="<?=$goodCode;?>" class="form__field txt-center<?php echo $class; ?>">
            <h2>Mariann</h2>
            <p class="error"><?php echo $goodCodeError; ?></p>
            <!--<a class="href__button" href="tiping_2.php">Let's go!</a>--> 
            <input type="submit" value="Let's go!" class="form__button"> 
        </form>

        <div class="w3-container">
            <div class="w3-progress-container">
                <div class="w3-progressbar" style="width:25%"></div>
            </div>

  
    </div>

</div>


<?php require("footer.php"); ?>