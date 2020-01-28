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


    function readOne(){

        // query to read single record
        $query = "SELECT
                v.id, v.nummer, v.inGebruik
            FROM
                " . $this->table_name . " v
           
            WHERE
                v.id = ?
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
        $this->nummer = $row['nummer'];
        $this->inGebruik = $row['inGebruik'];

    }


    function update(){


        $query = "UPDATE
                " . $this->table_name . "
            SET
                nummer = :nummer,
                inGebruik = :inGebruik
              
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nummer=htmlspecialchars(strip_tags($this->nummer));
        $this->inGebruik=htmlspecialchars(strip_tags($this->inGebruik));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':nummer', $this->nummer);
        $stmt->bindParam(':inGebruik', $this->inGebruik);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }


}
?>