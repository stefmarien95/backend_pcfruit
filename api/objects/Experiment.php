<?php
class Experiment{

    // database connection and table name
    private $conn;
    private $table_name = "Experiment";

    // object properties
    public $id;
    public $naam;
    public $opdrachtgever;
    public $opleverdatum;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // select all query
        $query = "SELECT
               e.id, e.naam,e.opdrachtgever,e.opleverdatum
            FROM
                " . $this->table_name . "e";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
?>