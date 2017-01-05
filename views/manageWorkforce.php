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
require('class/company_page.class.php');
$company = company_page::fetchCompanyByOwner($_SESSION['apiKey'],$_SESSION['userId']);
$companyId = $company[0]->id;
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




<?php
    require('footer.php');
?>