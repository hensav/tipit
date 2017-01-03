<?php

/**
 * Created by PhpStorm.
 * User: henrysavi
 * Date: 03/01/17
 * Time: 23:22
 */
class companyView
{
    private $PDO;

    public function __construct($PDO)
    {
        $this->conn = $PDO;
    }

    function fetchView($userID){
        $stmt = $this->conn->prepare(
            "SELECT company.trading_name, company.description, company.photo_url, company.coord_lat, company.coord_long, company.related_user, company.opening_hours,company.id, user.id
            FROM user
            LEFT JOIN company
            ON user.id=company.related_user
            WHERE user.id=:userId;
        ");

        $stmt->bindParam(':userId',$userID,PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

    }
}
