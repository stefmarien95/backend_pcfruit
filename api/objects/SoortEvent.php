<?php
/**
 * Created by PhpStorm.
 * User: maart
 * Date: 21/01/2020
 * Time: 09:20
 */

class SoortEvent
{
    private $conn;
    private $table_name = "SoortEvent";

    // object properties
    public $id;
    public $naam;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // select all query
        $query = "SELECT
               s.id,s.naam
            FROM
                " . $this->table_name . " s"

        ;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                naam=:naam";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->naam=htmlspecialchars(strip_tags($this->naam));



        // bind values
        $stmt->bindParam(":naam", $this->naam);



        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }

}