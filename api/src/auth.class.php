<?php

/**
 * Created by PhpStorm.
 * User: clstrfvck
 * Date: 29.11.2016
 * Time: 22:16
 */
class Auth
{
    public function __construct($PDO)
    {
        $this->conn = $PDO;
    }

    public function login($email,$pass){
        $stmt = $this->conn->prepare("
            SELECT id, role, name
            FROM user
            WHERE email=:email AND 
            auth=:authKey
        ");
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->bindParam(':authKey',$pass,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result['id']>1){
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

    public function fullRegister($name,$email,$phone,$auth,$role)
    {
        $stmt = $this->conn->prepare("
            SELECT id, role, name, email
            FROM user
            WHERE phone=:phoneNo OR WHERE email=:email
        ");
        $stmt->bindParam(':phoneNo', $phone, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $checking = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($checking['id'] > 1) {
            return array(
                'status'=>'error',
                'response'=>'Details already in use, please try again');
        } else {
            $stmt = $this->conn->prepare("
                INSERT INTO user VALUES(DEFAULT,:name,:email,:phone,:auth,:role,CURRENT_TIMESTAMP,NULL)
            ");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_INT);
            $stmt->bindParam(':auth', $auth, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return array(
                    'status'=>'success',
                    'response'=>'Full details registered!'
                );
            }
        }
    }

    public function firstRegister($phone,$pass,$role){
        $stmt = $this->conn->prepare("
        SELECT id, role
        FROM user
        WHERE phone=:phoneNo
        ");
        $stmt->bindParam('phoneNo',$phone,PDO::PARAM_STR);
        $stmt->execute();
        $checking=$stmt->fetch(PDO::FETCH_ASSOC);
        if($checking['id']>1){
            return array(
                'status'=>'error',
                'response'=>'Details already in use, please try again');
        } else {
            $stmt = $this->conn->prepare("
                INSERT INTO user(id,phone,auth,role,created,closed) VALUES(DEFAULT,:phone,:auth,:role,CURRENT_TIMESTAMP,NULL)
            ");

            $stmt->bindParam(':phone', $phone, PDO::PARAM_INT);
            $stmt->bindParam(':auth', $pass, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return array(
                    'status'=>'success',
                    'response'=>'Phone number and password registered!'
                );
            }
        }
    }


}