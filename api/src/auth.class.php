<?php

/**
 * Created by PhpStorm.
 * User: clstrfvck
 * Date: 29.11.2016
 * Time: 22:16
 */
class Auth
{
    private $conn;

    public function __construct($PDO)
    {
        $this->conn = $PDO;
    }

    public function login($email,$pass)
    {
        $stmt = $this->conn->prepare("
            SELECT user.id, user.role, user.name, api_key.apikey
            FROM user
            LEFT JOIN api_key ON user.id = api_key.user_id
            WHERE user.email=:email AND 
            auth=:authKey
        ");
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->bindParam(':authKey',$pass,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result['id']>1) {
            return array(
                'status' => 'success',
                'response' => $result
            );
        } else {
            return array(
                'status' => 'error',
                'response' => 'login failed!'
            );
        }
    }

    public function register($name,$email,$phone,$auth,$role)
    {
        $stmt = $this->conn->prepare("
            SELECT id, role, name, email
            FROM user
            WHERE email=:email
            LIMIT 1
        ");
        $stmt->bindParam(':email', $email, PDO::PARAM_INT);
        $stmt->execute();
        $checking = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($checking['id'] > 1) {
            return array(
                'status'=>'error',
                'response'=>'Details already in use, please try again');
        } else {

            //User with that e-mail didn't exist. Let's create one!
            $stmt = $this->conn->prepare("
                INSERT INTO user VALUES(DEFAULT,:name,:email,:phone,:auth,:role,CURRENT_TIMESTAMP,NULL)
            ");

            if (empty($phone)) {
                $phone = null;
            }

            if (empty($name)) {
                $name = null;
            }

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_INT);
            $stmt->bindParam(':auth', $auth, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $result =  array(
                    'status'=>'success',
                    'response'=>'Full details registered!',
                    'apikey' => $this->genApiKey($email)
                );
                if ($role == "employee") {
                    $gCode = $this->genGoodCode($name,$email);
                    $result['goodcode'] = $gCode;
                }

                if ($role == "employer") {
                    $this->genCompanyEntry($email);
                }

                return $result;
            }
        }
    }

    protected function genApiKey($email)
    {
        $key = substr(hash("sha512",$email.rand(1,1337)),rand(1,42),32);
        $stmt = $this->conn->prepare("
            INSERT INTO api_key(user_id,apikey) 
            VALUES((SELECT id FROM user WHERE email = :email LIMIT 1),:apikey);
        ");
        $stmt->bindParam(":email",$email,PDO::PARAM_STR);
        $stmt->bindParam(":apikey",$key,PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $key;
        }
    }

    protected function genDescriptionEntry($id)
    {
        $stmt = $this->conn->prepare("
          INSERT INTO emp_description(employee_id,photo_url)
          VALUES (:id, 'default.png')");
        $stmt->bindParam(":id", $id,PDO::PARAM_INT);
        $stmt->execute();
    }

    //Generate an entry into the company table
    protected function genCompanyEntry($email)
    {
        $stmt = $this->conn->prepare("
          INSERT INTO company(related_user,created)
        VALUES((SELECT id FROM user WHERE email = :email),CURRENT_TIMESTAMP)
        ");
        $stmt->bindParam(":email",$email,PDO::PARAM_STR);
        $stmt->execute();
    }

    //Generate 6-digit semi-random identifier for employee
    protected function genGoodCode($name,$email)
    {
        $nameArray = explode('_',$name);
        if (isset($nameArray[1])) {

            $inits= substr($nameArray[0],0,1).substr($nameArray[1],0,1);
            $goodCode = $inits.substr(hash("sha512",rand(0,1000)),0,4);

            $stmt= $this->conn->prepare("SELECT id FROM user WHERE name=:name AND email=:email");
            $stmt->bindParam(":name",$name,PDO::PARAM_STR);
            $stmt->bindParam(":email",$email,PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = intval($result['id']);

            $this->genDescriptionEntry($id);

            $stmt = $this->conn->prepare("INSERT INTO goodcode VALUES (DEFAULT,:uid,:gcode)");
            $stmt->bindParam(":uid",$id,PDO::PARAM_INT);
            $stmt->bindParam(":gcode",$goodCode,PDO::PARAM_STR);
            if ($stmt->execute()) {
                return $goodCode;
            }
        }
    }

    public function validateRequest($role, $id, $apikey)
    {

        $stmt = $this->conn->prepare("
            select user.role
            FROM user
            LEFT JOIN api_key as api on user.id = api.`user_id`
            WHERE user.id = :id AND api.apikey = :apikey
            LIMIT 1
        ");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":apikey", $apikey, PDO::PARAM_STR);

        if ($stmt->execute()) {

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!!$result) {
                if ($result['role'] == $role) {
                    return array(
                        "status" => "success"
                    );
                } else {
                    return array(
                        "status" => "failure",
                        "msg" => "User is of the wrong type"
                    );
                }
            } else {
                return array(
                    "status" => "failure",
                    "msg" => "API key mismatch"
                );
            }
        } else {
            return array(
                "status" => "failure",
                "msg" => "Issue with database"
            );
        }
    }
}