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

    public function fetchCompanyView($employerId)
    {
        $stmt = $this->conn->prepare("
          SELECT id,related_user email, trading_name, address, description, opening_hours, photo_url
          FROM company 
          WHERE related_user = :id
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


    function addDetails(array $input)
    {
        $updated = array();
        //if photo is updated..
        if(isset($input['filename']) && $input['filename'] != null){
            $stmt = $this->conn->prepare("
            UPDATE emp_description SET photo_url=:url WHERE employee_id=:id;
            ");
            $stmt->bindParam(":id",$input['employeeId'],PDO::PARAM_INT);
            $stmt->bindParam(":url",$input['filename'],PDO::PARAM_STR);
            if($stmt->execute()){
                $updated['picture']=true;
            }
        }

        //if description is updated
        if(isset($input['description']) && $input['description'] != null){
            $stmt = $this->conn->prepare("
            UPDATE emp_description SET description=:description WHERE employee_id=:id;
            ");
            $stmt->bindParam(":description",$input['description'],PDO::PARAM_STR);
            $stmt->bindParam(":id",$input['employeeId'],PDO::PARAM_INT);
            if($stmt->execute()){
                $updated['description']=true;
            }
        }
        return array(
            "status" => "success",
            "updated"=>$updated
        );



