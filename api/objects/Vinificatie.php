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
    public $wijnTypeId;
    public $jaargang;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function read(){

        // select all query
        $query = "SELECT
               v.id, v.vatId,v.persmethodeId,v.persHoeveelheid,v.oogst,v.persDruk,v.actief, v.wijnTypeId, v.jaargang
            FROM
                " . $this->table_name . " v
                 LEFT JOIN
                    Persmethode pe
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

    function actief(){

        // select all query
        $query = "SELECT
               v.id, v.vatId,v.persmethodeId,v.persHoeveelheid,v.oogst,v.persDruk,v.actief, v.wijnTypeId, v.jaargang
            FROM
                " . $this->table_name . " v
                 LEFT JOIN
                    Persmethode pe
                        ON  v.persmethodeId= pe.id
           
                 LEFT JOIN
                    Vat va
                        ON v.vatId= va.id
                 WHERE
                    actief=1      
                        
                  ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function nietActief(){

        // select all query
        $query = "SELECT
               v.id, v.vatId,v.persmethodeId,v.persHoeveelheid,v.oogst,v.persDruk,v.actief, v.wijnTypeId, v.jaargang
            FROM
                " . $this->table_name . " v
                 LEFT JOIN
                    Persmethode pe
                        ON  v.persmethodeId= pe.id
           
                 LEFT JOIN
                    Vat va
                        ON v.vatId= va.id
                 WHERE
                    actief=0      
                        
                  ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    function getLast(){

        // select all query
        $query = "SELECT
               v.id, v.vatId,v.persmethodeId,v.persHoeveelheid,v.oogst,v.persDruk,v.actief, v.wijnTypeId, v.jaargang
            FROM
                " . $this->table_name . " v
                 LEFT JOIN
                    Persmethode pe
                        ON  v.persmethodeId= pe.id
           
                 LEFT JOIN
                    Vat va
                        ON v.vatId= va.id
                 ORDER BY 
                    v.id 
                 DESC 
                    LIMIT 1      
                        
                  ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function readOne(){


        $query = "SELECT
               v.id, v.vatId, v.persmethodeId, v.persHoeveelheid, v.oogst, v.persDruk, v.actief, v.wijnTypeId, v.jaargang
            FROM
                " . $this->table_name . " v
                 LEFT JOIN
                    Persmethode pe
                        ON  v.persmethodeId= pe.id
           
                 LEFT JOIN
                    Vat va
                        ON v.vatId= va.id
                  WHERE
                    v.id = ?
                 LIMIT
                    0,1
                        ";

        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->vatId = $row['vatId'];
        $this->persmethodeId = $row['persmethodeId'];
        $this->persHoeveelheid = $row['persHoeveelheid'];
        $this->oogst = $row['oogst'];
        $this->persDruk = $row['persDruk'];
        $this->actief = $row['actief'];
        $this->wijnTypeId = $row['wijnTypeId'];
        $this->jaargang = $row['jaargang'];

        return $stmt;
    }

    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                vatId=:vatId, persmethodeId=:persmethodeId,persHoeveelheid=:persHoeveelheid, oogst=:oogst, persDruk=:persDruk, actief=:actief, wijnTypeId=:wijnTypeId, jaargang=:jaargang";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->vatId=htmlspecialchars(strip_tags($this->vatId));
        $this->persmethodeId=htmlspecialchars(strip_tags($this->persmethodeId));
        $this->persHoeveelheid=htmlspecialchars(strip_tags($this->persHoeveelheid));
        $this->oogst=htmlspecialchars(strip_tags($this->oogst));
        $this->persDruk=htmlspecialchars(strip_tags($this->persDruk));
        $this->actief=htmlspecialchars(strip_tags($this->actief));
        $this->wijnTypeId=htmlspecialchars(strip_tags($this->wijnTypeId));
        $this->jaargang=htmlspecialchars(strip_tags($this->jaargang));




        // bind values
        $stmt->bindParam(":vatId", $this->vatId);
        $stmt->bindParam(":persmethodeId", $this->persmethodeId);
        $stmt->bindParam(":persHoeveelheid", $this->persHoeveelheid);
        $stmt->bindParam(":oogst", $this->oogst);
        $stmt->bindParam(":persDruk", $this->persDruk);
        $stmt->bindParam(":actief", $this->actief);
        $stmt->bindParam(":wijnTypeId", $this->wijnTypeId);
        $stmt->bindParam(":jaargang", $this->jaargang);

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
                vatId=:vatId, persmethodeId=:persmethodeId, persHoeveelheid=:persHoeveelheid, oogst=:oogst, persDruk=:persDruk, actief=:actief, wijnTypeId=:wijnTypeId, jaargang=:jaargang

            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->vatId=htmlspecialchars(strip_tags($this->vatId));
        $this->persmethodeId=htmlspecialchars(strip_tags($this->persmethodeId));
        $this->persHoeveelheid=htmlspecialchars(strip_tags($this->persHoeveelheid));
        $this->oogst=htmlspecialchars(strip_tags($this->oogst));
        $this->persDruk=htmlspecialchars(strip_tags($this->persDruk));
        $this->actief=htmlspecialchars(strip_tags($this->actief));
        $this->wijnTypeId=htmlspecialchars(strip_tags($this->wijnTypeId));
        $this->jaargang=htmlspecialchars(strip_tags($this->jaargang));

        // bind new values
        $stmt->bindParam(":vatId", $this->vatId);
        $stmt->bindParam(":persmethodeId", $this->persmethodeId);
        $stmt->bindParam(":persHoeveelheid", $this->persHoeveelheid);
        $stmt->bindParam(":oogst", $this->oogst);
        $stmt->bindParam(":persDruk", $this->persDruk);
        $stmt->bindParam(":actief", $this->actief);
        $stmt->bindParam(":wijnTypeId", $this->wijnTypeId);
        $stmt->bindParam(":jaargang", $this->jaargang);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }


}
?>