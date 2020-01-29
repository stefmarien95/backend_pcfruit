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
    public $soortAlarmId;
    public $vinificatieId;
    public $minimumwaarde;
    public $maximumwaarde;
    public $actief;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }



    function read(){

        // select all query
        $query = "SELECT
               a.id, a.soortAlarmId, a.vinificatieId, a.minimumwaarde, a.maximumwaarde, a.actief
            FROM
                " . $this->table_name . " a ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function getByVinificatieId()
    {
        // query to read single record
        $query = "SELECT
                a.id, a.soortAlarmId, a.vinificatieId, a.minimumwaarde, a.maximumwaarde, a.actief
            FROM
                " . $this->table_name . " a
           
            WHERE
                a.vinificatieId = ?
                ";



        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->vinificatieId);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                soortAlarmId=:soortAlarmId, minimumwaarde=:minimumwaarde, maximumwaarde=:maximumwaarde, vinificatieId=:vinificatieId, actief=:actief";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->soortAlarmId=htmlspecialchars(strip_tags($this->soortAlarmId));
        $this->vinificatieId=htmlspecialchars(strip_tags($this->vinificatieId));
        $this->minimumwaarde=htmlspecialchars(strip_tags($this->minimumwaarde));
        $this->maximumwaarde=htmlspecialchars(strip_tags($this->maximumwaarde));
        $this->actief=htmlspecialchars(strip_tags($this->actief));


        // bind values
        $stmt->bindParam(":soortAlarmId", $this->soortAlarmId);
        $stmt->bindParam(":vinificatieId", $this->vinificatieId);
        $stmt->bindParam(":minimumwaarde", $this->minimumwaarde);
        $stmt->bindParam(":maximumwaarde", $this->maximumwaarde);
        $stmt->bindParam(":actief", $this->actief);

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
                soortAlarmId = :soortAlarmId,
                minimumwaarde = :minimumwaarde,
                maximumwaarde = :maximumwaarde,
                vinificatieId = :vinificatieId,
                actief = :actief
                
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize

        $this->soortAlarmId=htmlspecialchars(strip_tags($this->soortAlarmId));
        $this->minimumwaarde=htmlspecialchars(strip_tags($this->minimumwaarde));
        $this->maximumwaarde=htmlspecialchars(strip_tags($this->maximumwaarde));
        $this->vinificatieId=htmlspecialchars(strip_tags($this->vinificatieId));
        $this->actief=htmlspecialchars(strip_tags($this->actief));
        $this->id=htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(':soortAlarmId', $this->soortAlarmId);
        $stmt->bindParam(':minimumwaarde', $this->minimumwaarde);
        $stmt->bindParam(':maximumwaarde', $this->maximumwaarde);
        $stmt->bindParam(':vinificatieId', $this->vinificatieId);
        $stmt->bindParam(':actief', $this->actief);
        $stmt->bindParam(':id', $this->id);


        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function getByVinificatie(){

        // query to read single record
        $query = "SELECT
                a.id, a.soortAlarmId, a.vinificatieId, a.minimumwaarde, a.maximumwaarde, a.actief
            FROM
                " . $this->table_name . " a
           
            WHERE
                a.vinificatieId = ? AND a.soortAlarmId = ?
            LIMIT
                0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->vinificatieId);
        $stmt->bindParam(2, $this->soortAlarmId);
        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->id = $row['id'];
        $this->soortAlarmId = $row['soortAlarmId'];
        $this->vinificatieId = $row['vinificatieId'];
        $this->minimumwaarde = $row['minimumwaarde'];
        $this->maximumwaarde = $row['maximumwaarde'];
        $this->actief = $row['actief'];



    }

    function readOne(){

        // select all query
        $query = "SELECT
                a.id, a.soortAlarmId, a.vinificatieId, a.minimumwaarde, a.maximumwaarde, a.actief
            FROM
                " . $this->table_name . " a
               
                 WHERE
                    a.id = ?
                 LIMIT
                    0,1
                        ";


        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->soortAlarmId = $row['soortAlarmId'];
        $this->vinificatieId = $row['vinificatieId'];
        $this->minimumwaarde = $row['minimumwaarde'];
        $this->maximumwaarde = $row['maximumwaarde'];
        $this->actief = $row['actief'];


        return $stmt;
    }


}