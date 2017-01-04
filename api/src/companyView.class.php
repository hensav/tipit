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

    function fetchView($companyId)
    {
        $stmt = $this->conn->prepare(
            "SELECT id, related_user, email, trading_name, address, coord_lat, coord_long, created, closed, description, opening_hours, photo_url
            FROM company
            WHERE id = :companyId
            LIMIT 1
         ");

        $stmt->bindParam(':companyId',$companyId,PDO::PARAM_INT);

        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return "Failed to find company";
        }


    }

    public function fetchEmployeesByCompany($companyId)
    {
        $stmt = $this->prepare("SELECT employee_id FROM rel_employee_company WHERE company_id = :id");
        $stmt->bindParam(":id",$companyId,PDO::PARAM_INT);
        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return "Failed to find employees";
        }
    }

    public function fetchCompanyByEmployee($employeeId)
    {
        $stmt = $this->prepare("SELECT company_id FROM rel_employee_company WHERE empolyee_id = :id");
        $stmt->bindParam(":id",$employeeId,PDO::PARAM_INT);
        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return "Failed to find company";
        }
    }
}
