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
            "SELECT id, related_user, email, trading_name, aadress, coord_lat, coord_long, created, closed, description, opening_hours, photo_url
            FROM company
         ");

        $stmt->bindParam(':userId',$userID,PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    public function fetchEmployeesByCompany($companyId)
    {
        $stmt = $this->prepare("SELECT employee_id FROM rel_employee_company WHERE company_id = :id");
        $stmt->bindParam(":id",$companyId,PDO::PARAM_INT);
        if($stmt->execute()){
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        }
    }
}
