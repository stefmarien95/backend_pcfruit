<?php
class VinificatieDruif{

    // database connection and table name
    private $conn;
    private $table_name = "VinificatieDruif";

    // object properties
    public $id;
    public $druifsoortId;
    public $vinificatieId;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


}
?>