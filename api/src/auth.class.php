<?php

/**
 * Created by PhpStorm.
 * User: clstrfvck
 * Date: 29.11.2016
 * Time: 22:16
 */
class auth
{
    public function __construct($PDO)
    {
        $this->conn = $PDO;
    }

    public function login($phone,$pass){
        $stmt = $this->conn->prepare("
            SELECT id, role, name, email
            FROM user
            WHERE phone=:phoneNo AND 
            WHERE auth=:authKey
        ");
        $stmt->bindParam(':phoneNo',$phone,PDO::PARAM_INT);
        $stmt->bindParam(':authKey',$pass,PDO::PARAM_STR);
        $stmt->execute;
        $result = $stmt->fetch();

        if(is_int($result['id'])){
            var_dump($result);
            return json_encode($result);
        } else {
            return 'login failed';
        }
    }

    public function register($name,$email,$phone,$auth,$role){
        $stmt = $this->conn->prepare("
            SELECT id, role, name, email
            FROM user
            WHERE phone=:phoneNo OR WHERE email=:email
        ");
        $stmt->bindParam(':phoneNo',$phone,PDO::PARAM_INT);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->execute();
        $checking=$stmt->fetch;
        if(is_int($checking['id'])){
            return 'Details already in use, please try again';
        } else {
            $stmt = $this->conn->prepare("
                INSERT INTO user VALUES(DEFAULT,:name,:email,:phone,:auth,:role,CURRENT_TIMESTAMP,NULL)
            ");
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->bindParam(':email',$email,PDO::PARAM_STR);
            $stmt->bindParam(':phone',$phone,PDO::PARAM_INT);
            $stmt->bindParam(':auth',$auth,PDO::PARAM_STR);
            $stmt->bindParam(':role',$role,PDO::PARAM_STR);

            if($stmt->execute()){
                return 'user registered!';
            }
        }
    }

}