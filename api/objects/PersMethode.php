<?php
class PersMethode{

    // database connection and table name
    private $conn;
    private $table_name = "Persmethode";

    // object properties
    public $id;
    public $methode;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // select all query
        $query = "SELECT
               pm.id, pm.methode
            FROM
                " . $this->table_name . " pm
                "
        ;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
?>