<?php

/**
 * Created by PhpStorm.
 * User: henrysavi
 * Date: 03/01/17
 * Time: 23:18
 */
class company_page
{
    public static function fetchCompanyData($companyId, $apikey)
    {
        $url="http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/companyView/companyId/$companyId";
        $result = file_get_contents($url);
        return json_decode($result);
    }

    public static function fetchCompanyByEmployee($employeeId, $apikey)
    {
        $url="http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/fetchCompanyByEmployee/employeeId/$employeeId";
        $result = file_get_contents($url);
        return json_decode($result);
    }

    public static function fetchEmployeesByCompany($companyId,$apikey)
    {
        $url = "http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/fetchEmployeesByCompany/companyId/$companyId";
        $result = file_get_contents($url);
        return json_decode($result);
    }

    public static function fetchCompanyByOwner($apikey, $ownerId)
    {
        $url = "http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/companyByOwner/ownerId/$ownerId";
        $result = file_get_contents($url);
        return json_decode($result);
    }

    public static function employeeManagementView($apikey,$companyId)
    {
        $url = "http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/employeeManagement/companyId/$companyId";
        $result = file_get_contents($url);
        return json_decode($result);
    }

    public static function printEmployeeManagement($input)
    {
        $name = explode("_",$input->name)[0];
        $imgRoot = "http://naturaalmajand.us/tipit/uploads/";
        $imgPath = $imgRoot.$input->photo_url;
        $rating = round($input->avgRating,2);
        echo("
            <div class='container__employee'>
                <div class='employeeThumbnail'><img class ='employeeThumbnail' src=$imgPath class='employeeThumbnail'></div>
                <div class='employeeName'>$name</div>
                <div class='employeeRating'>$rating</div>
            </div>");
    }

    public static function printEmployeeStatus($input)
    {
        $name = explode("_",$input->name)[0];
        $imgRoot = "http://naturaalmajand.us/tipit/uploads/";
        $imgPath = $imgRoot.$input->photo_url;
        $rating = round($input->avgRating,2);
        echo("
            <div class='container__employee'>
                <div class='employeeThumbnail'><img class ='employeeThumbnail' src=$imgPath class='employeeThumbnail'></div>
                <div class='employeeName'><a href='tiping_2.php?employeeId=$input->id'>$name</a></div>
                <div class='employeeRating'>$rating</div>
            </div>");
    }



    public static function addEmployee($apikey,$companyId,$goodCode)
    {
        $url = "http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/addEmployee/companyId/$companyId/goodCode/$goodCode";
        $result = file_get_contents($url);
        return json_decode($result);
    }

    public static function removeEmployee($apikey,$companyId,$goodCode)
    {
        $url = "http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/removeEmployee/companyId/$companyId/goodCode/$goodCode";
        $result = file_get_contents($url);
        return json_decode($result);
    }

}