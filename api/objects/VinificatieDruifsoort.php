<?php
class VinificatieDruifsoort{

    // database connection and table name
    private $conn;
    private $table_name = "VinificatieDruifsoort";

    // object properties

    public $druifsoortId;
    public $vinificatieId;
    public $druifsoort;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    function readDruif(){

        // select all query
        $query = "SELECT
              vd.druifsoortId,vd.vinificatieId, ds.druifsoort as druifsoort
            FROM
                " . $this->table_name . " vd
                 LEFT JOIN
                    Druifsoort ds
                        ON  vd.druifsoortId= ds.id
           
                 WHERE
                        vd.vinificatieId = ?
                 ";




        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->vinificatieId);

        // execute query
        $stmt->execute();




        return $stmt;
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