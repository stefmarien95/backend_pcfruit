<?php
/**
 * Created by PhpStorm.
 * User: maart
 * Date: 21/01/2020
 * Time: 09:24
 */

class AlarmData
{
// database connection and table name
    private $conn;
    private $table_name = "Alarmdata";

    // object properties
    public $id;
    public $naam;
    public $minimumwaarde;
    public $maximumwaarde;
    public $fysiekeSensorId;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }



    function read(){

        // select all query
        $query = "SELECT
               ad.id, ad.naam, ad.minimumwaarde, ad.maximumwaarde, ad.fysiekeSensorId
            FROM
                " . $this->table_name . " ad
                LEFT JOIN
                    FysiekeSensor fs
                        ON ad.fysiekeSensorId= fs.id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}