<?php
/**
 * Created by PhpStorm.
 * User: maart
 * Date: 21/01/2020
 * Time: 09:21
 */

class Event
{
    private $conn;
    private $table_name = "Event";

    // object properties
    public $id;
    public $soortEventId;
    public $vinificatieId;
    public $gebruikerId;
    public $datum;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function read(){

        // select all query
        $query = "SELECT
               e.id, e.soortEventId,e.vinificatieId,e.gebruikerId, e.datum
            FROM
                " . $this->table_name . " e
                 LEFT JOIN
                    SoortEvent se
                        ON  e.soortEventId= se.id
                LEFT JOIN
                    Vinificatie v
                        ON e.vinificatieId= v.id
                 LEFT JOIN
                    Gebruiker g
                        ON e.gebruikerId= g.id
                        
                  ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                soortEventId=:soortEventId, vinificatieId=:vinificatieId, gebruikerId=:gebruikerId, datum=:datum";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->soortEventId=htmlspecialchars(strip_tags($this->soortEventId));
        $this->vinificatieId=htmlspecialchars(strip_tags($this->vinificatieId));
        $this->gebruikerId=htmlspecialchars(strip_tags($this->gebruikerId));
        $this->datum=htmlspecialchars(strip_tags($this->datum));




        // bind values
        $stmt->bindParam(":soortEventId", $this->soortEventId);
        $stmt->bindParam(":vinificatieId", $this->vinificatieId);
        $stmt->bindParam(":gebruikerId", $this->gebruikerId);
        $stmt->bindParam(":datum", $this->datum);



        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }

    function getByVinificatieId(){

        // query to read single record
        $query = "SELECT
                e.id, e.soortEventId, e.vinificatieId, e.gebruikerId, e.datum
            FROM
                " . $this->table_name . " e
           
            WHERE
                e.vinificatieId = ?
            ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );


        $stmt->bindParam(1, $this->vinificatieId);

        // execute query
        $stmt->execute();

        return $stmt;



    }


    function delete(){

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE  id=:id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));



        // bind values
        $stmt->bindParam(":id", $this->id);




        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }


    function update(){


        $query = "UPDATE
                " . $this->table_name . "
             SET
                soortEventId = :soortEventId,
                vinificatieId = :vinificatieId,
                gebruikerId = :gebruikerId,
                datum = :datum
                
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize

        $this->soortEventId=htmlspecialchars(strip_tags($this->soortEventId));
        $this->vinificatieId=htmlspecialchars(strip_tags($this->vinificatieId));
        $this->gebruikerId=htmlspecialchars(strip_tags($this->gebruikerId));
        $this->datum=htmlspecialchars(strip_tags($this->datum));
        $this->id=htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(':soortEventId', $this->soortEventId);
        $stmt->bindParam(':vinificatieId', $this->vinificatieId);
        $stmt->bindParam(':gebruikerId', $this->gebruikerId);
        $stmt->bindParam(':datum', $this->datum);
        $stmt->bindParam(':id', $this->id);


        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
}