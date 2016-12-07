<?php

/**
 * Class employeeView
 * Returns required data for the employee to assess their performance
 *
 */

class employeeView{

    private $PDO;

    public function __construct($PDO)
    {
        $this->conn = $PDO;
    }

    function fetchView($employeeId){
        $stmt = $this->conn->prepare(
        "SELECT COUNT(main_score)as rating_count,
        (SELECT sum(amount) FROM transactions where employee_id=:employeeId) as earned,
        AVG(main_score)as main_score,
        AVG(param2_score) as rating_p2,
        AVG(param3_score) as rating_p3
        FROM ratings
        WHERE employee_id=:employeeId
        ");
        $stmt->bindParam(':employeeId',$employeeId,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}