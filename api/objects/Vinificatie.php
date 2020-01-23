<?php
class Vinificatie{

    // database connection and table name
    private $conn;
    private $table_name = "Vinificatie";

    // object properties
    public $id;
    public $vatId;
    public $persmethodeId;
    public $persHoeveelheid;
    public $oogst;
    public $persDruk;
    public $actief;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function read(){

        // select all query
        $query = "SELECT
               v.id, v.vatId,v.persmethodeId,v.actief,v.persHoeveelheid,v.oogst,v.persDruk
            FROM
                " . $this->table_name . " v
                 LEFT JOIN
                    PersMethode pe
                        ON  v.persmethodeId= pe.id
           
                 LEFT JOIN
                    Vat va
                        ON v.vatId= va.id
                        
                  ";

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
                vatId=:vatId, persmethodeId=:persmethodeId, naam=:naam, actief=:actief, persHoeveelheid=:persHoeveelheid, oogst=:oogst, persDruk=:persDruk";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->vatId=htmlspecialchars(strip_tags($this->vatId));
        $this->persmethodeId=htmlspecialchars(strip_tags($this->persmethodeId));
        $this->actief=htmlspecialchars(strip_tags($this->actief));
        $this->persHoeveelheid=htmlspecialchars(strip_tags($this->persHoeveelheid));
        $this->oogst=htmlspecialchars(strip_tags($this->oogst));
        $this->persDruk=htmlspecialchars(strip_tags($this->persDruk));




        // bind values
        $stmt->bindParam(":vatId", $this->vatId);
        $stmt->bindParam(":persmethodeId", $this->persmethodeId);
        $stmt->bindParam(":actief", $this->actief);
        $stmt->bindParam(":persHoeveelheid", $this->persHoeveelheid);
        $stmt->bindParam(":oogst", $this->oogst);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":persDruk", $this->persDruk);


        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }


}
?>