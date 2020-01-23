<?php
/**
 * Created by PhpStorm.
 * User: stef
 * Date: 21/01/2020
 * Time: 10:54
 */

class Rol
{

    // database connection and table name
    private $conn;
    private $table_name = "Rol";

    // object properties
    public $id;
    public $rolnaam;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // select all query
        $query = "SELECT
               r.id, r.rolnaam
            FROM
                " . $this->table_name . "r";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

}