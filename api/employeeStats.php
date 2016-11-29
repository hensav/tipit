<?php
/**
 * Created by PhpStorm.
 * User: clstrfvx
 * Date: 29.11.2016
 * Time: 11:08
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require('src/employeeView.class.php');
require('../../../dbdata.php');
$PDO = new PDO("mysql:dbname=$dbname;host=$location",$user,$pass);
$employee = new employeeView($PDO);
if(isset($_GET['employeeId'])){
    $employeeId=$_GET['employeeId'];
    $fetched = $employee->fetchView($employeeId);
    $response=array(
        'response_msg' => 'success',
        'content' => $fetched
    );
        echo "<pre>";
    print_r(json_encode($response));
    echo "</pre>";
} else {
    echo("These are not the droids you're looking for");
}
