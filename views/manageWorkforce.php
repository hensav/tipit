<?php
/**
 * Created by PhpStorm.
 * User: clstrfvck
 * Date: 05/01/2017
 * Time: 19:57
 */

session_start();
if($_SESSION['userRole'] != "employer"){
    header("location: index.php");
    exit();
}
require('class/companyPage.class.php');
$company = company_page::fetchCompanyByOwner($_SESSION['apiKey'],$_SESSION['userId']);
$companyId = $company[0]->id;
$companyName = $company[0]->trading_name;
$addAlert = "";

if(isset($_GET['addId'])){
    company_page::addEmployee($_SESSION['apiKey'],$companyId,$_GET['addId']);
    $addAlert = "Sent request to employee #".$_GET['addId'];
}

$managementView = company_page::employeeManagementView($_SESSION['apiKey'],$companyId);

require('header.php');
?>
    <div class="employee">
        <?=$addAlert?>
        <div class="companyKind">Restoran</div>
        <div class="container__company">
            <div class="companyName"><?php echo $companyName;?></div>
            <div class="companyRating"><a href="comp_welcome.php"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </div>
        </div>

    <h3>Your confirmed employees:</h3>
<?php
    //active workers
    $none = true;
    foreach($managementView as $item){
        if($item->status == 'active') {
            company_page::printEmployeeStatus($item);
            $none=false;
        }
    }
    if($none==true){
        echo('<span>You have no linked employees. Why not add a few?</span> ');
    }
?>
    <h3>Pending requests:</h3><br/>
<?php
    //pending
    $none = true;
    foreach($managementView as $item){
        if($item->status == 'pending') {
            company_page::printEmployeeStatus($item);
            $none=false;
        }
    }
    if($none==true){
        echo('<span>You have no pending requests.</span> ');
    }
?>

    <h3>Add employees</h3>
    <div id="suggest"></div>
    <form>
        <input class="form__field txt-center" type="text" id="goodcode" placeholder="Start by typing goodcode">
    </form>
    </div>

<script src="js/managementAjax.js"></script>
<?php
    require('footer.php');
?>