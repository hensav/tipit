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

}