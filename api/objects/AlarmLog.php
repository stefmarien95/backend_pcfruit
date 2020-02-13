<?php
/**
 * Created by PhpStorm.
 * User: stef
 * Date: 13/02/2020
 * Time: 9:40
 */

class AlarmLog
{
    private $conn;
    private $table_name = "AlarmLog";

    // object properties
    public $id;
    public $vinificatieId;
    public $bericht;
    public $datum;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function getByVinificatieId(){

        // query to read single record
        $query = "SELECT
                a.id, a.vinificatieId, a.bericht, a.datum
            FROM
                " . $this->table_name . " a
           
            WHERE
                a.vinificatieId = ? 
           ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );


        $stmt->bindParam(1, $this->vinificatieId);

        // execute query
        $stmt->execute();

        return $stmt;




    }

}