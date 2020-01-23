<?php
/**
 * Created by PhpStorm.
 * User: maart
 * Date: 21/01/2020
 * Time: 09:24
 */

class FysiekeSensor
{
    private $conn;
    private $table_name = "FysiekeSensor";

    // object properties
    public $id;
    public $soortSensorId;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function read(){

        // select all query
        $query = "SELECT
               fs.id, fs.soortSensorId
            FROM
                " . $this->table_name . " fs
                 LEFT JOIN
                    SoortSensor ss
                        ON  fs.soortSensorId= ss.id"

        ;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}