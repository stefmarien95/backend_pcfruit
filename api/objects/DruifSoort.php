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


    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                druifsoort=:druifsoort";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->druifsoort=htmlspecialchars(strip_tags($this->druifsoort));



        // bind values
        $stmt->bindParam(":druifsoort", $this->druifsoort);



        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }
}
?>