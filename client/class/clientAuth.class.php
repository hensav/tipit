<?php

/**
 * Created by PhpStorm.
 * User: henrysavi
 * Date: 30/11/16
 * Time: 15:41
 */
class clientAuth
{
    public function loginRequest($url,$email,$pass){
        $hashpass = hash('sha512',$pass);

        $fullurl = $url."apikey/123/email/$email/pass/$hashpass";
        $result = file_get_contents($fullurl);
        return $result;



    }




}
