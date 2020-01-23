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

    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                methode=:methode";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->methode=htmlspecialchars(strip_tags($this->methode));




        // bind values
        $stmt->bindParam(":methode", $this->methode);



        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }
}
?>