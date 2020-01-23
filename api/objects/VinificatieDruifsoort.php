<?php
class VinificatieDruifsoort{

    // database connection and table name
    private $conn;
    private $table_name = "VinificatieDruifsoort";

    // object properties
    public $id;
    public $druifsoortId;
    public $vinificatieId;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function create(){


        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                druifsoortId=:druifsoortId, vinificatieId=:vinificatieId";


        $stmt = $this->conn->prepare($query);


        $this->druifsoortId=htmlspecialchars(strip_tags($this->druifsoortId));
        $this->vinificatieId=htmlspecialchars(strip_tags($this->vinificatieId));





        // bind values
        $stmt->bindParam(":druifsoortId", $this->druifsoortId);
        $stmt->bindParam(":vinificatieId", $this->vinificatieId);


        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }


}
?>