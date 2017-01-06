<?php
/**
 * Created by PhpStorm.
 * User: clstrfvck
 * Date: 06/01/2017
 * Time: 01:10
 */


class Employee
{

    protected $id,$name,$goodcode,$apikey,$photoUrl,$description,$employer,$employmentStatus,$employmentId,
                $currP1,$currP2,$currP3,$lastP1,$lastP2,$lastp3,$conn;

    public function __construct($PDO,$id)
    {
        $this->conn=$PDO;
        $this->build($id);
    }

    private function build($id)
    {
        $stmt = $this->conn->prepare("
        SELECT user.id, name, goodcode, photo_url,descr.description,rel.company_id as employer,rel.status as employment,rel.id as employmentId,
        (SELECT AVG(main_score) WHERE submitted >= DATE(NOW()) - INTERVAL 7 DAY)as currP1,
        (SELECT AVG(param2_score) WHERE submitted >= DATE(NOW()) - INTERVAL 7 DAY)as currP2,
        (SELECT AVG(param3_score) WHERE submitted >= DATE(NOW()) - INTERVAL 7 DAY)as currP3,
        (SELECT AVG(main_score) WHERE submitted >= DATE(NOW()) - INTERVAL 14 DAY AND submitted < DATE(NOW()) - INTERVAL 7 DAY)as lastP1,
        (SELECT AVG(param2_score) WHERE submitted >= DATE(NOW()) - INTERVAL 14 DAY AND submitted < DATE(NOW()) - INTERVAL 7 DAY)as lastP2,
        (SELECT AVG(param3_score) WHERE submitted >= DATE(NOW()) - INTERVAL 14 DAY AND submitted < DATE(NOW()) - INTERVAL 7 DAY)as lastP3
        FROM user
        LEFT JOIN ratings ON ratings.`employee_id` = user.id
        LEFT JOIN goodcode ON goodcode.`user_id` = user.id
        LEFT JOIN rel_employee_company as rel on rel.`employee_id` = user.id
        LEFT JOIN emp_description as descr ON descr.`employee_id`= user.id
        LEFT JOIN api_key on api_key.`user_id` = user.id
        WHERE user.role = 'employee' AND user.id = :id
        GROUP BY user.id
        ");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $rawData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rawData[0] as $key=>$value){
            $this->$key = $value;
        }
    }

    public function fetch($input)
    {
        if(is_array($input)){
        $output = array();
        foreach($input as $key){
            if(isset($this->$key)) {
                $output[$key] = $this->$key;
            } else {
                $output[$key] = false;
            }
        }

        return $output;
        } elseif(is_string($input)){
            $output = $this->$input;
            return $output;
        } else {
            return false;
        }
    }
}