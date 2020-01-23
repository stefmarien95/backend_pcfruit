<?php
/**
 * Created by PhpStorm.
 * User: maart
 * Date: 21/01/2020
 * Time: 09:23
 */

class AlarmDataGebruiker
{
    private $conn;
    private $table_name = "AlarmdataGebruiker";

    // object properties
    public $id;
    public $naam;
    public $gebruikerId;
    public $alarmDataId;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // select all query
        $query = "SELECT
               adg.id, adg.naam, adg.gebruikerId, adg.alarmDataId
            FROM
                " . $this->table_name . " adg
                LEFT JOIN
                    Gebruiker g
                        ON adg.gebruikerId= g.id
                LEFT JOIN
                    AlarmData ad
                        ON adg.alarmDataId= ad.id
                  ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}