<?php

/**
 * Created by PhpStorm.
 * User: henrysavi
 * Date: 14/12/16
 * Time: 15:30
 */
class employeeView
{
    public static function fetchSliderData($employeeId, $apikey)
    {
        $url="http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/employeePrivateSliders/employeeId/$employeeId";
        $result = file_get_contents($url);
        return $result;
    }

    public static function fetchStats($employeeId, $apikey)
    {
        $url="http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/employeePrivateStats/employeeId/$employeeId";
        $result = file_get_contents($url);
        return $result;
    }

    public static function getDetails($employeeId,$apikey)
    {
       $url="http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/employeePage/employeeId/$employeeId";
       $result = file_get_contents($url);
       return json_decode($result);
    }

    public static function updateDetails($description,$fileName,$employeeId,$apikey)
    {

        $package = array(
            "description"=>$description,
            "filename"=>$fileName,
            "employeeId"=>$employeeId
        );
        $passPackage = http_build_query($package);
        $url="http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/submit/employeeDetails/package/$passPackage";
        $result = file_get_contents($url);
        return $result;
    }

    public static function getPendingRequests($employeeId, $apikey){
        $url = "http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/getPendingRequests/employeeId/$employeeId";
        $result = file_get_contents($url);
        return json_decode($result);
    }

    public static function respondToRequest($employeeId,$requestId,$response,$apikey){
        $url = "http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/respondToRequest/employeeId/$employeeId/requestId/$requestId/response/$response";
        $result = file_get_contents($url);
        return json_decode($result);
    }
}