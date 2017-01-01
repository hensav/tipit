<?php

/**
 * Created by PhpStorm.
 * User: henrysavi
 * Date: 14/12/16
 * Time: 15:30
 */
class employeeView
{
    public static function fetchSliderData($employeeId, $apikey){
        $url="http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/employeePrivateStats/employeeId/$employeeId";

        $result = file_get_contents($url);
        return $result;
    }
}