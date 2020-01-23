<?php
class soortMeting{

    // database connection and table name
    private $conn;
    private $table_name = "SoortMeting";

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
               s.id, s.naam 
            FROM
                " . $this->table_name . " s";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
?>