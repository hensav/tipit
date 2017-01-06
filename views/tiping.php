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
        $goodCodeError = "<p>".$result->msg."</p>";
    }
}

require("header.php"); ?>


<div class="employee">
    <form method="post" class="employee__auth">
        <input type="text" placeholder="Start typing to search.." name="goodCode" id="goodcode" value="<?=$goodCode;?>" class="form__field txt-center<?php echo $class; ?>">
        <?php echo $goodCodeError; ?>
        <div id="suggest"> <p>Please type goodcode or establishment name above</p></div>
        <input type="submit" value="Let's go!" class="form__button">
    </form>

    <div class="w3-container">
        <div class="w3-progress-container">
            <div class="w3-progressbar" style="width:25%"></div>
        </div>

        
    </div>

</div>
    <script src="js/searchAjax.js" type="text/javascript"></script>

<?php require("footer.php"); ?>