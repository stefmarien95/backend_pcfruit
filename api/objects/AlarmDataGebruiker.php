<?php
/**
 * Created by PhpStorm.
 * User: maart
 * Date: 21/01/2020
 * Time: 09:23
 */

class AlarmDataGebruiker
{
    private $conn;
    private $table_name = "AlarmdataGebruiker";

    // object properties

    public $gebruikerId;
    public $alarmdataId;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                gebruikerId=:gebruikerId, alarmdataId=:alarmdataId";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->gebruikerId=htmlspecialchars(strip_tags($this->gebruikerId));
        $this->alarmdataId=htmlspecialchars(strip_tags($this->alarmdataId));


        // bind values
        $stmt->bindParam(":gebruikerId", $this->gebruikerId);
        $stmt->bindParam(":alarmdataId", $this->alarmdataId);



        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }


    function delete(){

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE  gebruikerId=:gebruikerId AND alarmdataId =:alarmdataId";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->gebruikerId=htmlspecialchars(strip_tags($this->gebruikerId));
        $this->alarmdataId=htmlspecialchars(strip_tags($this->alarmdataId));


        // bind values
        $stmt->bindParam(":gebruikerId", $this->gebruikerId);
        $stmt->bindParam(":alarmdataId", $this->alarmdataId);



        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }


}