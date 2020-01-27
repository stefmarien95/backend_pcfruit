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

    function update(){


        $query = "UPDATE
                " . $this->table_name . "
             SET
                naam = :naam,
                minimumwaarde = :minimumwaarde,
                maximumwaarde = :maximumwaarde,
                fysiekeSensorId = :fysiekeSensorId
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize

        $this->naam=htmlspecialchars(strip_tags($this->naam));
        $this->minimumwaarde=htmlspecialchars(strip_tags($this->minimumwaarde));
        $this->maximumwaarde=htmlspecialchars(strip_tags($this->maximumwaarde));
        $this->fysiekeSensorId=htmlspecialchars(strip_tags($this->fysiekeSensorId));
        $this->id=htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(':naam', $this->naam);
        $stmt->bindParam(':minimumwaarde', $this->minimumwaarde);
        $stmt->bindParam(':maximumwaarde', $this->maximumwaarde);
        $stmt->bindParam(':fysiekeSensorId', $this->fysiekeSensorId);
        $stmt->bindParam(':id', $this->id);


        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
}