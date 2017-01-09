<?php

/**
 * Created by PhpStorm.
 * User: henrysavi
 * Date: 03/01/17
 * Time: 23:22
 */
class companyView
{
    private $conn;

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
        $stmt = $this->conn->prepare("
              SELECT rel.employee_id, user.name, emp_description.photo_url
              FROM rel_employee_company as rel
              LEFT JOIN user on rel.employee_id = user.id
              LEFT JOIN emp_description on rel.employee_id = emp_description.employee_id
              LEFT JOIN ratings on ratings.employee_id = rel.employee_id
              WHERE company_id = :id AND status = 'active'
              GROUP BY user.id
            ");
        $stmt->bindParam(":id",$companyId,PDO::PARAM_INT);
        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return "failed to find employees";
        }
    }

    public function fetchCompanyByEmployee($employeeId)
    {
        $stmt = $this->conn->prepare("
          SELECT company_id
          FROM rel_employee_company 
          WHERE employee_id = :id AND status = 'active'
          ");
        $stmt->bindParam(":id",$employeeId,PDO::PARAM_INT);
        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return "Failed to find company";
        }
    }

    public function fetchCompanyByOwner($ownerId)
    {
        $stmt = $this->conn->prepare("
          SELECT id, trading_name
          FROM company
          WHERE related_user = :id
          ");
        $stmt->bindParam(":id",$ownerId,PDO::PARAM_INT);
        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return "Failed to find company";
        }
    }

    public function employeeManagement($companyId)
    {
        $stmt = $this->conn->prepare("
            SELECT 	rel.`employee_id`, 
                `emp_description`.`photo_url`, 
                user.`name`, 
                user.id,
                rel.`status`,
                (SELECT (AVG(`param2_score`) + AVG(param3_score) + AVG(`main_score`))/3 
                    WHERE submitted >= DATE(NOW()) - INTERVAL 7 DAY) as avgRating
            FROM rel_employee_company as rel
            LEFT JOIN user ON rel.`employee_id` = user.`id`
            LEFT JOIN `emp_description` ON rel.`employee_id` = `emp_description`.`employee_id`
            LEFT JOIN ratings ON ratings.`employee_id` = rel.`employee_id`
            WHERE rel.company_id = :companyId AND rel.status IN('active','pending')
            GROUP BY rel.`employee_id`
        ");
        $stmt->bindParam(":companyId",$companyId,PDO::PARAM_INT);
        if($stmt->execute()){
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        } else {
            return "None found";
        }
    }

    public function addEmployee($companyId,$goodCode)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO rel_employee_company(company_id,employee_id,status) 
            VALUES(:companyId, (SELECT user_id FROM goodcode WHERE goodcode = :goodCode LIMIT 1),'pending');
        ");
        $stmt->bindParam(':companyId',$companyId,PDO::PARAM_INT);
        $stmt->bindParam(':goodCode',$goodCode,PDO::PARAM_STR);
        $stmt->execute();
        $resultId = $this->conn->lastInsertId();
        if(isset($resultId) && $resultId>0){
            return array(
                "status" => "success",
                "relationId" => $resultId
            );
        } else {
            return array(
                "status" => "error"

            );
        }
    }

    public function removeEmployee($companyId, $goodCode)
    {
        $stmt = $this->conn->prepare("
            UPDATE rel_employee_company as rel
            LEFT JOIN goodcode as gc on rel.employee_id = gc.user_id
            SET status='declined'
            WHERE gc.goodcode = :gc AND rel.company_id = :company;
        ");
        $stmt->bindParam(":gc",$goodCode,PDO::PARAM_STR);
        $stmt->bindParam(":company",$companyId,PDO::PARAM_INT);

        if ($stmt->execute()) {
            return array(
                "status" => "success",
                "msg" => "Removed $goodCode"
            );
        } else {
            return array(
                "status" => "failure"
            );
        }
    }
}