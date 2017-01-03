<?php

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
    function updateDetails(array $input)
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

    }

}