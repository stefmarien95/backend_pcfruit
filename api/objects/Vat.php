<?php
class vat{

    // database connection and table name
    private $conn;
    private $table_name = "Vat";

    // object properties
    public $id;
    public $nummer;
    public $inGebruik;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // select all query
        $query = "SELECT
               v.id, v.nummer,v.inGebruik
            FROM
                " . $this->table_name . " v";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
?>