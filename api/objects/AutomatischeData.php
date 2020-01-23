<?php
class AutomatischeData{

    // database connection and table name
    private $conn;
    private $table_name = "AutomatischeData";

    // object properties
    public $id;
    public $vinificatieId;
    public $fysiekeSensorId;
    public $waarde;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function read(){

        // select all query
        $query = "SELECT
               ad.id, ad.vinificatieId, ad.fysiekeSensorId, ad.waarde
            FROM
                " . $this->table_name . " ad
                LEFT JOIN
                    Vinificatie v
                        ON ad.vinificatieId= v.id
                LEFT JOIN
                    FysiekeSensor fs
                        ON ad.fysiekeSensorId= fs.id
                
                        
                  ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
?>