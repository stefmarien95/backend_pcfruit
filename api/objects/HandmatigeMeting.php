<?php
class HandmatigeMeting{

    // database connection and table name
    private $conn;
    private $table_name = "HandmatigeMeting";

    // object properties
    public $id;
    public $meting;
    public $tijd;
    public $soortMetingId;
    public $vinificatieId;
    public $gebruikerId;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // select all query
        $query = "SELECT
               hm.id, hm.meting,hm.tijd,hm.soortMetingId,hm.vinificatieId,hm.gebruikerId
            FROM
                " . $this->table_name . " hm
                 LEFT JOIN
                    SoortMeting sm
                        ON  hm.soortmetingId= sm.id
                 LEFT JOIN
                    Vinificatie v
                        ON hm.vinificatieId= v.id  
                  LEFT JOIN
                    Gebruiker g
                        ON  hm.gebruikerId= g.id     
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
                meting=:meting, tijd=:tijd, soortMetingId=:soortMetingId, vinificatieId=:vinificatieId, gebruikerId=:gebruikerId";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->meting=htmlspecialchars(strip_tags($this->meting));
        $this->tijd=htmlspecialchars(strip_tags($this->tijd));
        $this->soortMetingId=htmlspecialchars(strip_tags($this->soortMetingId));
        $this->vinificatieId=htmlspecialchars(strip_tags($this->vinificatieId));
        $this->gebruikerId=htmlspecialchars(strip_tags($this->gebruikerId));


        // bind values
        $stmt->bindParam(":meting", $this->meting);
        $stmt->bindParam(":tijd", $this->tijd);
        $stmt->bindParam(":soortMetingId", $this->soortMetingId);
        $stmt->bindParam(":vinificatieId", $this->vinificatieId);
        $stmt->bindParam(":gebruikerId", $this->gebruikerId);



        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }

    function getByVinificatieId(){


        $query = "SELECT
                h.id, h.soortMetingId, h.vinificatieId, h.gebruikerId, h.meting, h.tijd 
            FROM
                " . $this->table_name . " h
           
            WHERE
                h.vinificatieId = ?
                
            ORDER BY
                h.soortMetingId, h.tijd
                
            ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );


        $stmt->bindParam(1, $this->vinificatieId);

        // execute query
        $stmt->execute();

        return $stmt;



    }

}
?>