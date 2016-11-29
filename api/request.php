<?php
/**
 *
 */
require('src/auth.class.php');
require('../../../dbdata.php');
$PDO = new PDO("mysql:dbname=$dbname;host=$location",$user,$pass);
$Auth = new auth($PDO);
$params = array();
$parts = explode('/', $_SERVER['REQUEST_URI']);
//skip through the segments by 2
for($i = 0; $i < count($parts); $i = $i + 2){
    $params[$parts[$i]] = $parts[$i+1];
}

$_GET = $params;
if(isset($_GET['apikey'])) {
    //do autenthication thing with API key
    if (isset($_GET['view'])) {

        if ($_GET['view'] == 'employeePrivateStats') {
            echo "performance analysis stuff for employee";
        }
        if ($_GET['view'] == 'employeePage') {
            echo "View for client, allows reading employee description and";
        }
        if ($_GET['view'] == 'employeesByCompany') {
            echo "returns names, photo-urls and ratings of employees in company";
        }
        if ($_GET['view'] == 'getNearbyCompanies') {
            echo "nearby restaurants view based on coordinates";
        }
        if ($_GET['view'] == 'submitRating') {
            echo "leaves rating";
        }
    }
    if (isset($_GET['submit'])){
        if($_GET['submit']=='login'){
            if(isset($_GET['phone'])&&isset($_GET['pass'])){
                $response = $Auth->login($_GET['phone'],$_GET['pass']);
                print_r(json_encode($response));
            }else{
                echo "these are not the droids you're looking for";
            }
        }

        if($_GET['submit']=='shortRegistration'){
            if(isset($_GET['phone'])&&isset($_GET['pass'])&&isset($_GET['role'])) {
                $regPass = hash('sha512',$_GET['pass']);
                $response = $Auth->firstRegister($_GET['phone'],$pass,$_GET['role']);
                print_r(json_encode($response));
            }else{
                echo "these are not the droids you're looking for";
            }
        }

        if($_GET['submit']=='rateEmployee'){
            echo "hindamise script";
        }
        if($_GET['submit']=='employeeAddDetails'){
            echo "Töötaja lisab siin oma detaile.";
        }
        if($_GET['submit']=='register'){
            echo "registreerimisskript jookseb siin";
        }
    }
    else {
        echo 'You have no power here';
    }
}