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



    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                nummer=:nummer, inGebruik=:inGebruik";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nummer=htmlspecialchars(strip_tags($this->nummer));
        $this->inGebruik=htmlspecialchars(strip_tags($this->inGebruik));




        // bind values
        $stmt->bindParam(":nummer", $this->nummer);
        $stmt->bindParam(":inGebruik", $this->inGebruik);


        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }


}
?>