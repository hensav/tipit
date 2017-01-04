<?php
/**
 * Router for incoming GET requests.
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('../../../dbdata.php');
$PDO = new PDO("mysql:dbname=$dbname;host=$location",$user,$pass,

    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")

);
$params = array();
$parts = explode('/', $_SERVER['REQUEST_URI']);
//skip through the segments by 2
for($i = 0; $i < count($parts); $i = $i + 2) {
    $params[$parts[$i]] = $parts[$i + 1];
}

$_GET = $params;
if(isset($_GET['apikey'])) {

    //do autenthication thing with API key

    if (isset($_GET['view'])) {

        if ($_GET['view'] == 'employeePrivateSliders') {
            require('src/employeeView.class.php');
            $employeeView = new employeeView($PDO);
            if(isset($_GET['employeeId'])){
                $result = $employeeView->getBarValues($_GET['employeeId']);
                print_r(json_encode($result));
            }
        }

        if ($_GET['view'] == 'employeePrivateStats') {
            require('src/employeeView.class.php');
            $employeeView = new employeeView($PDO);
            if(isset($_GET['employeeId'])){
                $result = $employeeView->getStatValues($_GET['employeeId']);
                print_r(json_encode($result));
            }
        }

        if ($_GET['view'] == 'employeeByGoodcode') {
            require('src/employeeView.class.php');
            $employeeView = new employeeView($PDO);
            if(isset($_GET['goodCode'])){
                $result = $employeeView->getEmployeeByGoodcode($_GET['goodCode']);
                print_r(json_encode($result));
            }
        }


        if ($_GET['view'] == 'employeePage') {
            //emp_description
            require('./src/emp_description.class.php');
            $emp_description = new emp_description($PDO);
            if (isset($_GET["employeeId"]) && !empty($_GET["employeeId"])) {
                $result = $emp_description->fetchView($_GET["employeeId"]);
                print_r(json_encode($result));
            }

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


        if ($_GET['view'] == 'companyView') {
            require('src/companyView.class.php');
            $companyView = new companyView($PDO);
            if(isset($_GET['userId'])){
                $result = $companyView->fetchView($_GET["userId"]);
                print_r(json_encode($result));
            }
        }
    }

    elseif (isset($_GET['submit'])) {
        //initialize auth src and class
        require('./src/auth.class.php');
        $Auth = new Auth($PDO);


        if ($_GET['submit'] == 'login') {
            if (isset($_GET['email']) && isset($_GET['pass'])) {
                $response = $Auth->login($_GET['email'], $_GET['pass']);
                print_r(json_encode($response));
            } else {
                echo "these are not the droids you're looking for (login)";
            }
        }

        //first registration


        if ($_GET['submit'] == 'rateEmployee') {
            require("src/employeeRating.class.php");
            $queryString = $_GET['package'];
            parse_str($queryString,$output);
            $rate = new employeeRating($PDO);
            $response = $rate->leaveRating($output);
            print_r(json_encode($response));
        }
        //Adding and changing employee details
        if ($_GET['submit'] == 'employeeDetails') {
            require("src/emp_description.class.php");
            $queryString = $_GET['package'];
            parse_str($queryString,$output);
            $editing = new emp_description($PDO);
            $response = $editing->updateDetails($output);
            print_r(json_encode($response));
        }

        //main registration script
        if ($_GET['submit'] == 'register') {
            if (isset($_GET['email']) && isset($_GET['pass']) && isset($_GET['role'])
            ) {
                $response = $Auth->register($_GET['name'], $_GET['email'], $_GET['phone'], $_GET['pass'], $_GET['role']);
                print_r(json_encode($response));
            } else {
                echo "these are not the droids you're looking for!";
            }
        }
    } elseif(isset($_GET['search'])) {

        if ($_GET['search'] == 'byGoodcode') {
            require("src/search.class.php");
            $search = new search($PDO);
            $response = $search->byGoodcode(stripslashes(htmlspecialchars($_GET['goodcode'])));
            print_r($response);
        }

        if ($_GET['search'] == 'byCompany') {
            require("src/search.class.php");
            $search = new search($PDO);
            $response = $search->byCompany(stripslashes(htmlspecialchars($_GET['company'])));
            print_r($response);
        }

    }


    else {
        echo 'You have no power here';
    }
}

