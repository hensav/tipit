<?php

/**
 * Class employeeView
 * Returns
 */


class employeeView{

    private $PDO;

    private function __construct($PDO)
    {
        $this->conn = $PDO;
    }

    function fetchView($employeeId){
        $stmt = $this->conn->prepare(
        #SQL query here



        #WHERE user.id=:employeeId
        );
        $stmt->bindParam('employeeId',$employeeId,PDO::PARAM_INT);
        $stmt->execute;
        $result = $stmt->fetchAll();
        $this->conn->close;
        return json_encode($result);
    }
}