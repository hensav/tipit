<?php

/**
 * Created by PhpStorm.
 * User: henrysavi
 * Date: 02/01/17
 * Time: 18:33
 */

class clientView
{
    public static function fetchEmployeeData($employeeId, $apikey){

        $url="http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/employeePage/employeeId/$employeeId";
        $result = file_get_contents($url);
        return $result;
    }

    public static function fetchEmployeeByGoodcode($gCode, $apikey){
        $url="http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/employeeByGoodcode/goodCode/$gCode";
        $result = json_decode(file_get_contents($url));
        return $result;
    }
}