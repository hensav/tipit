<?php 

$companyName = "Toompea Tina";
 ?>

<?php require("header.php");
if(isset($_GET['C'])){
    $cId = $_GET['C'];
    echo "<script>var cId = $cId</script>";
} else {

}
?>

    <div class="welcome">
        <h1 class="txt-center">You are great! Thank you!</h1>
        <?php if(isset($cId)){ ?>
        <p class="txt-center"><a href="company.php">View the complete profile of <?php echo $companyName ?></a></p>

        <script>
            setTimeout(function () {
            window.location.href= 'company.php?companyId='+cId
            },3000);//3sec
        </script>
    <? } else {?>
            <p class="txt-center"><a href="tiping.php">View another company or customer</a></p>
        <?php }?>
    </div>

<?php require("footer.php"); ?>