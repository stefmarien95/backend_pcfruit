<?php
/**
 * Created by PhpStorm.
 * User: stef
 * Date: 12/02/2020
 * Time: 11:38
 */

class WijnType
{
    private $conn;
    private $table_name = "WijnType";

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
               w.id, w.naam
            FROM
                " . $this->table_name . " w"

        ;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    function readOne(){


        $query = "SELECT
                w.id, w.naam
            FROM
                " . $this->table_name . " w
            WHERE
                w.id = ?
            LIMIT
                0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->id = $row['id'];
        $this->naam = $row['naam'];

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

    function update(){


        $query = "UPDATE
                " . $this->table_name . "
             SET
                naam = :naam
                
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize

        $this->naam=htmlspecialchars(strip_tags($this->naam));
        $this->id=htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(':naam', $this->naam);
        $stmt->bindParam(':id', $this->id);


        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }


    function delete(){

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE  id=:id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));



        // bind values
        $stmt->bindParam(":id", $this->id);




        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }


}