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

    function leaveRating(array $input)
    {
        //$client_id, $employee_id, $main_score, $param2_score, $param3_score

        $stmt = $this->conn->prepare(
            "INSERT INTO ratings(client_id, employee_id, main_score, param2_score, param3_score, submitted)
            VALUES(:client_id, :employee_id, :main_score, :param2_score, :param3_score, CURRENT_TIMESTAMP)"
            );

        if(empty($param2_score)){
            $param2_score=null;
        }
        if(empty($param3_score)){
            $param3_score=null;
        }
        $stmt->bindParam(':client_id',$input['from'],PDO::PARAM_INT);
        $stmt->bindParam(':employee_id',$input['to'],PDO::PARAM_INT);
        $stmt->bindParam(':main_score',$input['quick'],PDO::PARAM_INT);
        $stmt->bindParam(':param2_score',$input['punctual'],PDO::PARAM_INT);
        $stmt->bindParam(':param3_score',$input['helpful'],PDO::PARAM_INT);

        if($stmt->execute()){
            return array(
                "status" => "success",
                "msg" => "Rating left, thanks!"
            );
        } else {
            return array(
                "status" => "failure",
                "msg" => "Uh-oh, something went horribly awry! Please try again."
            );
        }

    }
}
