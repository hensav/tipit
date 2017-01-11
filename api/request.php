<?php
/**
 * Router for incoming GET requests.
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../../dbdata.php';

header('Access-Control-Allow-Origin: *');

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
if (isset($_GET['apikey'])) {
    $apikey = $_GET['apikey'];

    require_once "src/auth.class.php";
    $validation = new Auth($PDO);

    if (isset($_GET['view'])) {

        if ($_GET['view'] == 'employeePrivateSliders') {
            $check = $validation->validateRequest('employee',$_GET['employeeId'],$apikey);
            if ($check['status'] == 'success') {

                require 'src/employeeView.class.php';
                $employeeView = new employeeView($PDO);
                if (isset($_GET['employeeId'])) {
                    $result = $employeeView->getBarValues($_GET['employeeId']);
                    print_r(json_encode($result));
                }

            } else {
                print_r(json_encode(array("status" => "failure", "msg" => $check['msg'])));
                exit();
            }
        }

        if ($_GET['view'] == 'getPendingRequests') {

            $check = $validation->validateRequest('employee',$_GET['employeeId'],$apikey);
            if ($check['status'] == 'success') {

                require 'src/employeeView.class.php';
                $employeeView = new employeeView($PDO);

                if (isset($_GET['employeeId'])) {
                    $result = $employeeView->getPendingRequests($_GET['employeeId']);
                    print_r(json_encode($result));
                }
            } else {
                print_r(json_encode(
                    array("status" => "failure", "msg" => $check['msg'])

                ));
                exit();
            }

        }

        if ($_GET['view'] == 'respondToRequest') {
            $check = $validation->validateRequest('employee',$_GET['employeeId'],$apikey);

            if ($check['status'] == 'success') {

                require 'src/employeeView.class.php';
                $employeeView = new employeeView($PDO);
                if (isset($_GET['employeeId']) && isset($_GET['response']) && isset($_GET['requestId'])) {
                    $result = $employeeView->respondToRequest($_GET['employeeId'],$_GET['requestId'],$_GET['response']);
                    print_r(json_encode($result));
                }
            } else {
                print_r(json_encode(array("status" => "failure", "msg" => $check['msg'])));
                exit();
            }
        }

        if ($_GET['view'] == 'employeePrivateStats') {

            $check = $validation->validateRequest('employee',$_GET['employeeId'],$apikey);
            if ($check['status'] == 'success') {

                require 'src/employeeView.class.php';
                $employeeView = new employeeView($PDO);
                if (isset($_GET['employeeId'])) {
                    $result = $employeeView->getStatValues($_GET['employeeId']);
                    print_r(json_encode($result));
                }
            } else {
                print_r(json_encode(array("status" => "failure", "msg" => $check['msg'])));
                exit();
            }
        }

        if ($_GET['view'] == 'employeeByGoodcode') {
            require('src/employeeView.class.php');
            $employeeView = new employeeView($PDO);
            if (isset($_GET['goodCode'])) {
                $result = $employeeView->getEmployeeByGoodcode($_GET['goodCode']);
                print_r(json_encode($result));
            }
        }


        if ($_GET['view'] == 'employeePage') {
            //emp_description
            require './src/employeeDescription.class.php';
            $emp_description = new emp_description($PDO);
            if (isset($_GET["employeeId"]) && !empty($_GET["employeeId"])) {
                $result = $emp_description->fetchView($_GET["employeeId"]);
                print_r(json_encode($result));
            }

        }

        //To be implemented
        if ($_GET['view'] == 'getNearbyCompanies') {
            echo "nearby restaurants view based on coordinates - to be implemented";
        }


        if ($_GET['view'] == 'companyView') {
            require 'src/companyView.class.php';
            $companyView = new companyView($PDO);
            if (isset($_GET['companyId'])) {
                $result = $companyView->fetchView($_GET["companyId"]);
                print_r(json_encode($result));
            }
        }


        if ($_GET['view'] == 'fetchEmployeesByCompany') {
            require 'src/companyView.class.php';
            $companyView = new companyView($PDO);
            if (isset($_GET['companyId'])) {
                $result = $companyView->employeeManagement($_GET["companyId"]);
                print_r(json_encode($result));
            }
        }

        if ($_GET['view'] == 'fetchCompanyByEmployee') {
            require 'src/companyView.class.php';
            $companyView = new companyView($PDO);
            if (isset($_GET['employeeId'])) {
                $result = $companyView->fetchCompanyByEmployee($_GET["employeeId"]);
                print_r(json_encode($result));
            }
        }


        if ($_GET['view'] == 'employeeManagement') {
            require 'src/companyView.class.php';
            $companyView = new companyView($PDO);
            if (isset($_GET['companyId'])) {
                $result = $companyView->employeeManagement($_GET['companyId']);
                print_r(json_encode($result));
            }
        }


        if ($_GET['view'] == 'addEmployee') {
            require 'src/companyView.class.php';
            $companyView = new companyView($PDO);
            if (isset($_GET['companyId']) && isset($_GET['goodCode'])) {
                $result = $companyView->addEmployee($_GET['companyId'],$_GET['goodCode']);
                print_r(json_encode($result));
            }
        }

        if ($_GET['view'] == 'removeEmployee') {
            require "src/companyView.class.php";
            $companyView = new companyView($PDO);
            if (isset($_GET['companyId']) && isset($_GET['goodCode'])) {
                $result = $companyView->removeEmployee($_GET['companyId'],$_GET['goodCode']);
                print_r(json_encode($result));
            }
        }

        if ($_GET['view'] == 'companyByOwner') {
            require 'src/companyView.class.php';
            $companyView = new companyView($PDO);
            if (isset($_GET['ownerId'])) {
                $result = $companyView->fetchCompanyByOwner($_GET['ownerId']);
                print_r(json_encode($result));
            }
        }



        if ($_GET['view'] == 'compWelcome') {
            require 'src/compWelcome.class.php';
            $compWelcome = new compWelcome($PDO);
            if (isset($_GET['employerId'])) {
                $result = $compWelcome->fetchEmployerById($_GET["employerId"]);
                print_r(json_encode($result));
            }
        }


        if ($_GET['view'] == 'fetchCompanyView') {
            require 'src/compWelcome.class.php';
            $compWelcome = new compWelcome($PDO);
            if (isset($_GET['employerId'])) {
                $result = $compWelcome->fetchCompanyView($_GET["employerId"]);
                print_r(json_encode($result));
            }
        }
//////////


        if ($_GET['view'] == 'isEmployerNew') {
            require 'src/compWelcome.class.php';
            $compWelcome = new compWelcome($PDO);
            if (isset($_GET['employerId'])) {
                $result = $compWelcome->isEmployerNew($_GET['employerId']);
                print_r(json_encode($result));
            }
        }
    }

    elseif (isset($_GET['submit'])) {
        //initialize auth src and class
        $Auth = new Auth($PDO);


        if ($_GET['submit'] == 'login') {
            if (isset($_GET['email']) && isset($_GET['pass'])) {
                $response = $Auth->login($_GET['email'], $_GET['pass']);
                print_r(json_encode($response));
            } else {
                echo "these are not the droids you're looking for (login)";
            }
        }



        if ($_GET['submit'] == 'rateEmployee') {
            require "src/employeeRating.class.php";
            $queryString = $_GET['package'];
            parse_str($queryString,$output);
            $rate = new employeeRating($PDO);
            $response = $rate->leaveRating($output);
            print_r(json_encode($response));
        }



        if ($_GET['submit'] == 'employeeDetails') {
            require "src/employeeDescription.class.php";
            $queryString = $_GET['package'];
            parse_str($queryString,$output);
            $editing = new emp_description($PDO);
            $response = $editing->updateDetails($output);
            print_r(json_encode($response));
        }


        //Adding and changing company details
        if ($_GET['submit'] == 'companyDetails') {
            require "src/compWelcome.class.php";
            $queryString = $_GET['package'];
            parse_str($queryString,$output);
            $editing = new compWelcome($PDO);
            $response = $editing->addDetails($output);
            print_r(json_encode($response));
        }

        //main registration script
        if ($_GET['submit'] == 'register') {
            if (isset($_GET['email']) && isset($_GET['pass']) && isset($_GET['role'])
            ) {
                $response = $Auth->register($_GET['name'], $_GET['email'],
                    $_GET['phone'], $_GET['pass'], $_GET['role']);
                print_r(json_encode($response));
            } else {
                echo "these are not the droids you're looking for!";
            }
        }

    } elseif (isset($_GET['search'])) {
        require"src/search.class.php";

        if ($_GET['search'] == 'byGoodcode') {
            $search = new search($PDO);
            $response = $search->byGoodcode(stripslashes(htmlspecialchars($_GET['goodcode'])));
            print_r($response);
        }

        if ($_GET['search'] == 'byCompany') {
            $search = new search($PDO);
            $response = $search->byCompany(stripslashes(htmlspecialchars($_GET['company'])));
            print_r($response);
        }

    }

    else {
        echo 'You have no power here';
    }

}


