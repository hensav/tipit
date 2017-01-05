<?php

/**
 * Created by PhpStorm.
 * User: henrysavi
 * Date: 03/01/17
 * Time: 23:18
 */
class company_page
{
    public static function fetchcompanyData($companyId, $apikey)
    {
        $url="http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/companyView/companyId/$companyId";
        $result = file_get_contents($url);
        return $result;
    }

    public static function fetchCompanyByEmployee($employeeId, $apikey)
    {
        $url="http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/fetchCompanyByEmployee/employeeId/$employeeId";
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

    public static function printEmployeeStatus($input)
    {
        //["employee_id"]=> string(2) "10" ["photo_url"]=> string(12) "4bf0d840.jpg"
        // ["name"]=> string(18) "Töökas_Töötaja" ["status"]=> string(6) "active"
        $name = explode("_",$input->name)[0];
        $imgRoot = "http://naturaalmajand.us/tipit/uploads/";
        $imgPath = $imgRoot.$input->photo_url;
        $rating = 5;
        echo("
            <div class='container__employee'>
                <div class='employeeThumbnail'><img src=$imgPath class='employeeThumbnail'></div>
                <div class='employeeName'>$name</div>
            </div>");
    }

    public static function addEmployee($apikey,$companyID,$goodCode)
    {
        $url = "http://naturaalmajand.us/tipit/api/request.php/apikey/$apikey/view/addEmployee/companyId/$companyID/goodCode/$goodCode";
        $result = file_get_contents($url);
        return json_decode($result);
    }

}