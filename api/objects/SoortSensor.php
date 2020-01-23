<?php
class SoortSensor{

    // database connection and table name
    private $conn;
    private $table_name = "SoortSensor";

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
}
?>