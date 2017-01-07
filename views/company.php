<?php

session_start();
require("class/companyPage.class.php");
/*
$companyName = "Lendav Taldrik";
$companyImgUrl = "http://www.northestonia.eu/sites/default/files/styles/large/public/visitestonia_pics/d0b4f1cdca0e3e3aadc1bf3eab9029ba.jpg?itok=4PnXFqtH";
$companyDescription = "Me ei ole tüüpiline Aasia restoran. Tule ja vaata, milles kogu kära!";
$companyOpen = "Mo—Fri 10—20; Sa—Su 10—00";
$companyAddress = "Toomrüütli 666, Tallinn";

$companyKind = "Restoran";
$companyName = "Toompea Tina";
$employeeName = "Jüri Vokiratas";
$employeeRating = "3.6";
$companyRating = "0.6";
*/

$apikey = $_SESSION['apiKey'];
$companyId = $_GET['company'];

$data = company_page::fetchCompanyData($companyId,$apikey);
$company = $data[0];

$employees = company_page::fetchEmployeesByCompany($companyId,$apikey);


//dummydata
$trading_name = "";
$photo_url = "";
$description = "";
$opening_hours = "";
$address = "";

?>

<?php require("header.php"); ?>
<div class="employee">
	<h2><?php echo $company->trading_name; ?></h2>
	<div class="company__profile">   
	    <img src=<?=$company->photo_url?> class="employee-image">
	    <div class="container__companyAddress">
	    	<div class="addressPin"><img src="../uploads/emp_thumbnail.png" class="employeeThumbnail"></div>
	    	<div class="address"><p class="companyAddress"><?php echo $company->address;?></p></div>
	    </div>
	    <div class="container__companyAddress">
	    	<div class="addressPin"></div>
	    	<div class="address"><p><?php echo $company->opening_hours; ?></p></div>
	    </div>
    </div>
	    <p class="companyDescription"><?php echo $company->description; ?></p>
	</div>
    <?=$employeeSection?>
    <? foreach($employees as $employee){
            if($employee->status == "active") {
                company_page::printEmployeeStatus($employee);
            }
        }
?>
</div>


<?php require("footer.php"); ?>