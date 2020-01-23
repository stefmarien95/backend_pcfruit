<?php
class DruifSoort{

    // database connection and table name
    private $conn;
    private $table_name = "DruifSoort";

    // object properties
    public $id;
    public $druifsoort;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // select all query
        $query = "SELECT
               ds.id, ds.druifsoort 
            FROM
                " . $this->table_name . " ds";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
?>