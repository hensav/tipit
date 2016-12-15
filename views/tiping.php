<?php


$goodCode = "";
$goodCodeError = ""; 
$class = "";

if (isset ($_POST["goodCode"]) &&
    !empty ($_POST["goodCode"])) {
    if (strlen($_POST["goodCode"]) == 6
        ) {
        header("Location: tiping_2.php");
    
    } else {

        $goodCode = $_POST["goodCode"];
    }
}

if (isset ($_POST["goodCode"])) {
    if (strlen($_POST["goodCode"]) != 6 ||
        empty($_POST["goodCode"])) {
        $goodCodeError = "Incorrect Good Code";
        $class = " hasError";
}

}



?>


<?php require("header.php"); ?>


    <div class="employee">
        <form method="POST" class="employee__auth">
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