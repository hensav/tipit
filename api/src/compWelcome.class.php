<?php

/**
 * Created by PhpStorm.
 * User: henrysavi
 * Date: 04/01/17
 * Time: 21:29
 */
class compWelcome
{
    private $PDO;

    public function __construct($PDO)
    {
        $this->conn = $PDO;
    }

    public function fetchEmployerById($employerId)
    {
        $stmt = $this->conn->prepare("
          SELECT id,name
          FROM user 
          WHERE id = :id
          ");
        $stmt->bindParam(":id",$employerId,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function isEmployerNew($employerId){
        $stmt = $this->conn->prepare('
            SELECT id, trading_name
            FROM company
            WHERE related_user=:employerId
        ');
        $stmt->bindParam(":employerId", $employerId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!!$result) {
            return false;
        } else {
            return true;
        }

    }


    public function addDetails($related_user,$trading_name,$email,$address,$description,$opening_hours)
    {


            $stmt = $this->conn->prepare("
                INSERT INTO company VALUES(DEFAULT,:related_user,:email,:trading_name,:address,NULL,NULL,CURRENT_TIMESTAMP,NULL,:description,:opening_hours,NULL)
            ");

            $stmt->bindParam(':related_user', $related_user, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':trading_name', $trading_name, PDO::PARAM_INT);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':opening_hours', $opening_hours, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $result =  array(
                    'status'=>'success',
                    'response'=>'Company details saved',
                );
                return $result;
            }

    }
}



