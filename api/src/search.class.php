<?php

/**
 * Created by PhpStorm.
 * User: clstrfvck
 * Date: 04/01/2017
 * Time: 20:03
 */
class search
{
    private $PDO;

    public function __construct($PDO)
    {
        $this->PDO = $PDO;
    }

    public function byGoodcode($entry)
    {
        $searchTerm = "%".$entry."%";

        $stmt = $this->PDO->prepare("
            SELECT user_id AS id, user.name, emp_description.photo_url, goodcode
            FROM goodcode
            LEFT JOIN user ON goodcode.user_id = user.id
            LEFT JOIN emp_description on goodcode.user_id = emp_description.employee_id
            WHERE goodcode.goodcode LIKE :term
            UNION ALL
            SELECT id, trading_name as name, 'company','n/a'
            FROM company
            WHERE company.trading_name LIKE :term
        ");

        $stmt->bindParam(":term",$searchTerm,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($result)>0){
            return json_encode($result);
        } else {
            return json_encode(array(
                "id" => null,
                "goodcode" => null,
                "name" => "Not found",
                "photo_url"=>"default.jpg"
            ));
        }
    }

    public function byCompany($entry)
    {
        $searchTerm = "%".$entry."%";

        $stmt = $this->PDO->prepare("
            SELECT id, trading_name AS name
            FROM company
            WHERE trading_name LIKE :term
        ");

        $stmt->bindParam(":term",$searchTerm,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($result)>0){
            return json_encode($result);
        } else {
            return json_encode("No result");
        }
    }
}