<?php

/**
 * Created by PhpStorm.
 * User: henrysavi
 * Date: 01/12/16
 * Time: 14:51
 */
class employeeRating
{
    private $PDO;

    public function __construct($PDO)
    {
        $this->conn = $PDO;
    }

    function leaveRating($client_id, $employee_id, $main_score, $param2_score, $param3_score, $submitted){
        $stmt = $this->conn->prepare(
            "
            
            ");


        $stmt->bindParam(':client_id',$client_id,PDO::PARAM_INT);
        $stmt->bindParam(':employee_id',$employee_id,PDO::PARAM_INT);
        $stmt->bindParam(':main_score',$main_score,PDO::PARAM_INT);
        $stmt->bindParam(':param2_score',$param2_score,PDO::PARAM_INT);
        $stmt->bindParam(':param3_score',$param3_score,PDO::PARAM_INT);
        $stmt->bindParam(':submitted',$submitted,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

}