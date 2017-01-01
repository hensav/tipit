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

    function getBarValues($employeeId){
        $stmt = $this->conn->prepare(
        "SELECT
        AVG((main_score+param2_score+param3_score)/3) as total,
        AVG(main_score)as P1,
        AVG(param2_score) as P2,
        AVG(param3_score) as P3
		FROM ratings
		WHERE employee_id=:employeeId AND submitted >= DATE(NOW()) - INTERVAL 7 DAY
        union ALL
        SELECT
        AVG((main_score+param2_score+param3_score)/3) as total,
        AVG(main_score)as P1,
        AVG(param2_score) as P2,
        AVG(param3_score) as P3
		FROM ratings
		WHERE employee_id=:employeeId 
        ");
        $stmt->bindParam(':employeeId',$employeeId,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}