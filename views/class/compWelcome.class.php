<?php

/**
 * Created by PhpStorm.
 * User: henrysavi
 * Date: 06/01/17
 * Time: 15:26
 */
class compWelcome
{
    public static function getEmployer($apikey,$employerId)
    {
        $url = "http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/compWelcome/employerId/$employerId";
        $result = file_get_contents($url);
        return json_decode($result);
    }

    public static function isEmployerNew($apikey,$employerId)
    {
        $url = "http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/isEmployerNew/employerId/$employerId";
        $result = file_get_contents($url);
        return json_decode($result);
    }

    public function addDetails($apikey,$related_user,$trading_name,$email,$address,$description,$opening_hours){

        $url="http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/submit/submit/related_user/$related_user/trading_name/$trading_name/email/$email/address/$address/description/$description/opening_hours/$opening_hours";
        $result = file_get_contents($url);
        return json_decode($result);
    }
}