<?php
/**
 * Created by PhpStorm.
 * User: clstrfvck
 * Date: 07/01/2017
 * Time: 10:16
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require('../../../dbdata.php');
require('src/auth.class.php');

header('Access-Control-Allow-Origin: *');

$PDO = new PDO("mysql:dbname=$dbname;host=$location",$user,$pass,

    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")

);

$test = new Auth($PDO);
//employer validation with the correct details - should succeed
$result1 = $test->validateRequest('employer',135,'3fe3d3aa6e59f2bddd31c877404a4e23');
//Client validation with details of employer - should fail
$result2 = $test->validateRequest('client',135,'3fe3d3aa6e59f2bddd31c877404a4e23');
//Client validation with the correct details - should succeed
$result3 = $test->validateRequest('client',151,'beb655a4e5e562fdbbc8ba33fa6a8aac');


print_r($result1);
print_r($result2);
print_r($result3);

/*
Wrapper callidele mis tagastavad privaatseid andmeid:

    $validate->validateRequest(role,userId,apikey);
    if ($validate['status'] == 'success') {

            +++++ function call +++++

    } else {
        print_r(json_encode(
            array("status" => "failure", "msg" => $validate['msg']);
            exit();
        ));
    }

 */
