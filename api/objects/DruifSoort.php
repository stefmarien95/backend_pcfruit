<?php
class DruifSoort{

    // database connection and table name
    private $conn;
    private $table_name = "Druifsoort";

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
               d.id, d.druifsoort 
            FROM
                " . $this->table_name . " d
            ORDER BY d.druifsoort";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function delete(){

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE  id=:id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));



        // bind values
        $stmt->bindParam(":id", $this->id);




        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
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


    function update(){


        $query = "UPDATE
                " . $this->table_name . "
             SET
                druifsoort = :druifsoort
                
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize

        $this->druifsoort=htmlspecialchars(strip_tags($this->druifsoort));
        $this->id=htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(':druifsoort', $this->druifsoort);
        $stmt->bindParam(':id', $this->id);


        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

}
?>