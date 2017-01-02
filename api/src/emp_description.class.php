<?php

/**
 * Created by PhpStorm.
 * User: henrysavi
 * Date: 01/12/16
 * Time: 15:41
 */
class emp_description
{
    private $PDO;

    public function __construct($PDO)
    {
        $this->conn = $PDO;
    }

    function fetchView($employeeId){
        $stmt = $this->conn->prepare(

            "SELECT emp_description.employee_id, emp_description.description, emp_description.photo_url, user.name
            FROM emp_description
            LEFT JOIN user
            ON user.id=emp_description.employee_id
            WHERE emp_description.employee_id=:employeeId;
        ");
        $stmt->bindParam(':employeeId',$employeeId,PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

    }
    function updateDetails(array $input){
        $stmt = $this->conn->prepare("
        UPDATE emp_description SET photo_url=:url, description=:description WHERE employee_id=:id;
        ");
        $stmt->bindParam(":url",$input['filename'],PDO::PARAM_STR);
        $stmt->bindParam(":description",$input['description'],PDO::PARAM_STR);
        $stmt->bindParam(":id",$input['employeeId'],PDO::PARAM_INT);
        if($stmt->execute()){
            return array(
                "status" => "success",
                "message" => "Profile successfully updated!"
            );
        } else {
            return array(
                "status" => "failure",
                "message" => "Something went awry."
            );
        }
    }
}