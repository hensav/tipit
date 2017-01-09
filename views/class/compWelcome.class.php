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

    public static function fetchCompanyView($apikey,$employerId)
    {
        $url = "http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/fetchCompanyView/employerId/$employerId";
        $result = file_get_contents($url);
        return json_decode($result);
    }

    public static function isEmployerNew($apikey,$employerId)
    {
        $url = "http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/isEmployerNew/employerId/$employerId";
        $result = file_get_contents($url);
        return json_decode($result);
    }

    public static function addDetails($photo_url,$apikey,$related_user,$trading_name,$email,$address,$description,$opening_hours)
    {
        $package = array();

        if(isset($apikey) && !empty($apikey)){
            $package['apikey'] = $apikey;
        }

        if(isset($description) && !empty($description)){
            $package['description'] = $description;
        }

        if(isset($photo_url) && !empty($photo_url)){
            $package['photo_url'] = $photo_url;
        }

        if(isset($related_user) && !empty($related_user)){
            $package['related_user'] = $related_user;
        }

        if(isset($trading_name) && !empty($trading_name)){
            $package['trading_name'] = $trading_name;
        }

        if(isset($email) && !empty($email)){
            $package['email'] = $email;
        }

        if(isset($address) && !empty($address)){
            $package['address'] = $address;
        }

        if(isset($opening_hours) && !empty($opening_hours)){
            $package['opening_hours'] = $opening_hours;
        }

        //var_dump($package);

        $passPackage = http_build_query($package);
        $url="http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/submit/companyDetails/package/$passPackage";
        $result = file_get_contents($url);
        return json_decode($result);
    }




}



