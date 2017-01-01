<?php
/**
 *
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

        if ($_GET['view'] == 'employeePrivateStats') {
            require('src/employeeView.class.php');
            $employeeView = new employeeView($PDO);
            if(isset($_GET['employeeId'])){
                $result = $employeeView->getBarValues($_GET['employeeId']);
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

        if ($_GET['submit'] == 'shortRegistration') {
            if (isset($_GET['email']) && isset($_GET['pass']) && isset($_GET['role'])) {
                $regPass = hash('sha512', $_GET['pass']);
                $response = $Auth->firstRegister($_GET['email'], $regPass, $_GET['role']);
                print_r(json_encode($response));
            } else {
                echo "these are not the droids you're looking for (1reg)";
            }
        }
        if ($_GET['submit'] == 'followUpRegistration') {
            //carry on after finishing short registration
        }

        if ($_GET['submit'] == 'rateEmployee') {
            echo "hindamise script";
        }
        if ($_GET['submit'] == 'employeeAddDetails') {
            echo "Töötaja lisab siin oma detaile.";
        }

        if ($_GET['submit'] == 'register') {

            if (isset($_GET['email']) && isset($_GET['pass']) && isset($_GET['role'])

            ) {
                $response = $Auth->register($_GET['name'], $_GET['email'], $_GET['phone'], $_GET['pass'], $_GET['role']);
                print_r(json_encode($response));
            } else {
                echo "these are not the droids you're looking for!";
            }
        }
    } else {
        echo 'You have no power here';
    }
}

