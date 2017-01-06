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
        $url="http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/compWelcome/employerId/$employerId";
        $result = file_get_contents($url);
        return json_decode($result);
    }
}