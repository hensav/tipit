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

    public function fetchEmployerById($employerId) //testitud
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

    public function fetchCompanyView($employerId) //testitud
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
            UPDATE company SET photo_url=:url WHERE related_user=:id;
            ");
            $stmt->bindParam(":id",$input['related_user'],PDO::PARAM_INT);
            $stmt->bindParam(":url",$input['filename'],PDO::PARAM_STR);
            if($stmt->execute()){
                $updated['picture']=true;
            }
        }

        //if trading_name is updated
        if(isset($input['trading_name']) && $input['trading_name'] != null){
            $stmt = $this->conn->prepare("
            UPDATE company SET trading_name=:trading_name WHERE related_user=:id;
            ");
            $stmt->bindParam(":trading_name",$input['trading_name'],PDO::PARAM_STR);
            $stmt->bindParam(":id",$input['related_user'],PDO::PARAM_INT);
            if($stmt->execute()){
                $updated['trading_name']=true;
            }
        }

        //if email is updated
        if(isset($input['email']) && $input['email'] != null){
            $stmt = $this->conn->prepare("
            UPDATE company SET email=:email WHERE related_user=:id;
            ");
            $stmt->bindParam(":email",$input['email'],PDO::PARAM_STR);
            $stmt->bindParam(":id",$input['related_user'],PDO::PARAM_INT);
            if($stmt->execute()){
                $updated['email']=true;
            }
        }

        //if address is updated
        if(isset($input['address']) && $input['address'] != null){
            $stmt = $this->conn->prepare("
            UPDATE company SET address=:address WHERE related_user=:id;
            ");
            $stmt->bindParam(":address",$input['address'],PDO::PARAM_STR);
            $stmt->bindParam(":id",$input['related_user'],PDO::PARAM_INT);
            if($stmt->execute()){
                $updated['address']=true;
            }
        }

        //if description is updated
        if(isset($input['description']) && $input['description'] != null){
            $stmt = $this->conn->prepare("
            UPDATE company SET description=:description WHERE related_user=:id;
            ");
            $stmt->bindParam(":description",$input['description'],PDO::PARAM_STR);
            $stmt->bindParam(":id",$input['related_user'],PDO::PARAM_INT);
            if($stmt->execute()){
                $updated['description']=true;
            }
        }


        //if opening_hours is updated

        if(isset($input['opening_hours']) && $input['opening_hours'] != null){
            $stmt = $this->conn->prepare("
            UPDATE company SET opening_hours=:opening_hours WHERE related_user=:id;
            ");
            $stmt->bindParam(":opening_hours",$input['opening_hours'],PDO::PARAM_STR);
            $stmt->bindParam(":id",$input['related_user'],PDO::PARAM_INT);
            if($stmt->execute()){
                $updated['opening_hours']=true;
            }
        }
        return array(
            "status" => "success",
            "updated"=>$updated
        );



    }
}
