<?php
class SoortAlarm{

    // database connection and table name
    private $conn;
    private $table_name = "SoortAlarm";

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
               ss.id, ss.naam
            FROM
                " . $this->table_name . "ss";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function readOne(){

        // query to read single record
        $query = "SELECT
                s.id, s.naam
            FROM
                " . $this->table_name . " s
           
            WHERE
                s.id = ?
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

}
