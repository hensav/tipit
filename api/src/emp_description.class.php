s<?php

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
}