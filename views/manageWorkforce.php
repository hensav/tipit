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

if(isset($_GET['addId'])){
    company_page::addEmployee($_SESSION['apiKey'],$companyId,$_GET['addId']);
}

$managementView = company_page::employeeManagementView($_SESSION['apiKey'],$companyId);

require('header.php');
?>
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
    <form>
        <input type="text" id="goodcode">
    </form>
    <div id="suggest"></div>


<script src="js/managementAjax.js"></script>
<?php
    require('footer.php');
?>