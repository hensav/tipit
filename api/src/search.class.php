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
            SELECT user_id AS id, goodcode, user.name
            FROM goodcode
            LEFT JOIN user ON goodcode.user_id = user.id
            WHERE goodcode LIKE :term
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