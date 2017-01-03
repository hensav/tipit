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

    function getBarValues($employeeId)
    {
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
        AND submitted >= DATE(NOW()) - INTERVAL 14 DAY
        AND submitted < DATE(NOW()) - INTERVAL 7 DAY
        ");
        $stmt->bindParam(':employeeId',$employeeId,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getStatValues($employeeId)
    {
        $stmt = $this->conn->prepare("
        SELECT COUNT(ratings.id) as ratingCount,SUM(transactions.amount) as earnings
        FROM ratings
        LEFT JOIN transactions on ratings.employee_id = transactions.employee_id
        WHERE ratings.employee_id = :id 
        AND ratings.submitted >= DATE(NOW()) - INTERVAL 7 DAY
        ");

        $stmt->bindParam(":id",$employeeId,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getEmployeeByGoodcode($gCode)
    {
        $stmt = $this->conn->prepare("
        SELECT user_id as id, goodcode
        FROM goodcode
        WHERE goodcode = :goodcode
        LIMIT 1
        ");
        $stmt->bindParam(":goodcode",$gCode,PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch();

        if(intval($result['id'])>0){
            return(array(
                "status"=>"success",
                "msg"=>$result['id'],
            ));
        } else {
            return(array(
                "status"=>"failure",
                "msg"=>"Unable to find employee by $gCode!"
            ));
        }
    }


}