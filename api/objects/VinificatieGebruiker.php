<?php
/**
 * Created by PhpStorm.
 * User: maart
 * Date: 21/01/2020
 * Time: 09:21
 */

class VinificatieGebruiker
{
    private $conn;
    private $table_name = "VinificatieGebruiker";

    // object properties

    public $gebruikerId;
    public $vinificatieId;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // select all query
        $query = "SELECT
               vg.gebruikerId,vg.vinificatieId
            FROM
                " . $this->table_name . " vg
                 LEFT JOIN
                    Gebruiker g
                        ON  vg.gebruikerId= g.id
                LEFT JOIN
                    Vinificatie v
                        ON vg.vinificatieId= v.id
                
                        
                  ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}