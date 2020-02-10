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

    function readOne(){

        // query to read single record
        $query = "SELECT
                p.id, p.methode
            FROM
                " . $this->table_name . " p
           
            WHERE
                p.id = ?
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
        $this->methode = $row['methode'];

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