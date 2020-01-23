<?php
class HandmatigeMeting{

    // database connection and table name
    private $conn;
    private $table_name = "HandmatigeMeting";

    // object properties
    public $id;
    public $meting;
    public $tijd;
    public $soortmetingId;
    public $vinificatieId;
    public $gebruikerId;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // select all query
        $query = "SELECT
               hm.id, hm.meting,hm.tijd,hm.soortmetingId,hm.vinificatieId,hm.gebruikerId
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
}
?>