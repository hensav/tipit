<?php

session_start();
if($_SESSION['userRole'] != "client"){
    header("location: index.php");
    exit();
}

require("class/clientView.class.php");

$goodCodeError = "";

$apikey = $_SESSION['apikey'];

if (isset ($_POST["goodCode"]) && !empty ($_POST["goodCode"])) {
    $result = clientView::fetchEmployeeByGoodcode($_POST['goodCode'],$apikey);
    if($result->status=="success"){
        $id = $result->msg;
        header("location: tiping_2.php?employeeId=$id");
    } else {
        $goodCodeError = $result->msg;
    }
}

require("header.php"); ?>


    <div class="employee">
        <form method="post" class="employee__auth">
            <input type="text" placeholder="The good code" name="goodCode" value="<?=$goodCode;?>" class="form__field txt-center<?php echo $class; ?>">
           
            <p class="error"><?php echo $goodCodeError; ?></p>
            <!--<a class="href__button" href="tiping_2.php">Let's go!</a>--> 
            <input type="submit" value="Let's go!" class="form__button"> 
        </form>

        <br><br>



        <form method="post" class="company_search">
            <input type="text" placeholder="Or start typing company name..." name="company" value="" class="form__field txt-center">

            <p class="error"><?php echo $companyError; ?></p>
            <!--<a class="href__button" href="tiping_2.php">Let's go!</a>-->
        </form>



        <div class="w3-container">
            <div class="w3-progress-container">
                <div class="w3-progressbar" style="width:25%"></div>
            </div>

  
    </div>

</div>


<?php require("footer.php"); ?>