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

    public $gebruikerId;
    public $alarmdataId;
    public $alarmData_vinificatieId;
    public $alarmData_soortAlarmId;
    public $alarmData_minimumwaarde;
    public $alarmData_maximumwaarde;
    public $alarmData_actief;

    public $alarmData_vinificatie_vatId;
    public $alarmData_vinificatie_persmethodeId;
    public $alarmData_vinificatie_persHoeveelheid;
    public $alarmData_vinificatie_oogst;
    public $alarmData_vinificatie_persDruk;
    public $alarmData_vinificatie_actief;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // select all query
        $query = "SELECT
               a.gebruikerId, a.alarmdataId 
            FROM
                " . $this->table_name . " a";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    /*
    function readOne(){

        // query to read single record
        $query = "SELECT
                a.gebruikerId, a.alarmdataId 
            FROM
                " . $this->table_name . " a
           
            WHERE
                a.id = ?
            LIMIT
                0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->nummer = $row['nummer'];
        $this->inGebruik = $row['inGebruik'];

    }
    */

    function getByGebruikerId(){

        // query to read single record
        $query = "SELECT
                a.gebruikerId, a.alarmdataId 
            FROM
                " . $this->table_name . " a
           
            WHERE
                a.gebruikerId = ?
            ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );


        $stmt->bindParam(1, $this->gebruikerId);

        // execute query
        $stmt->execute();

        return $stmt;

        // get retrieved row
        //$row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        //$this->gebruikerId = $row['gebruikerId'];
        //$this->alarmdataId = $row['alarmdataId'];

    }

    function getByAlarmData(){

        // query to read single record
        $query = "SELECT
                a.gebruikerId, a.alarmdataId, ad.soortAlarmId as alarmData_soortAlarmId, ad.vinificatieId as alarmData_vinificatieId, ad.minimumwaarde as alarmData_minimumwaarde, ad.maximumwaarde as alarmData_maximumwaarde, ad.actief as alarmData_actief, 
                v.vatId as alarmData_vinificatie_vatId, v.persmethodeId as  alarmData_vinificatie_persmethodeId, v.persHoeveelheid as alarmData_vinificatie_persHoeveelheid, v.oogst as alarmData_vinificatie_oogst, v.persDruk as alarmData_vinificatie_persDruk, v.actief as alarmData_vinificatie_actief
                
                
            FROM
                " . $this->table_name . " a
                LEFT JOIN
                    Alarmdata ad
                        ON a.alarmdataId  = ad.id
                         LEFT JOIN
                    Vinificatie v
                        ON ad.vinificatieId  = v.id
                        
             WHERE
                a.gebruikerId = ?
                
              GROUP BY
                 v.vatId
            ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );


        $stmt->bindParam(1, $this->gebruikerId);

        // execute query
        $stmt->execute();

        return $stmt;


    }

    function getRest(){

        // query to read single record
        $query = "SELECT
                a.gebruikerId, a.alarmdataId, ad.soortAlarmId as alarmData_soortAlarmId, ad.vinificatieId as alarmData_vinificatieId, ad.minimumwaarde as alarmData_minimumwaarde, ad.maximumwaarde as alarmData_maximumwaarde, ad.actief as alarmData_actief, 
                v.vatId as alarmData_vinificatie_vatId, v.persmethodeId as  alarmData_vinificatie_persmethodeId, v.persHoeveelheid as alarmData_vinificatie_persHoeveelheid, v.oogst as alarmData_vinificatie_oogst, v.persDruk as alarmData_vinificatie_persDruk, v.actief as alarmData_vinificatie_actief
                
                
            FROM
                " . $this->table_name . " a
                LEFT JOIN
                    Alarmdata ad
                        ON a.alarmdataId  = ad.id
                         LEFT JOIN
                    Vinificatie v
                        ON ad.vinificatieId  = v.id
                        
             WHERE 
                a.gebruikerId = ? AND v.actief = 1 
                
             
                
            GROUP BY
                 v.vatId
            ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );


        $stmt->bindParam(1, $this->gebruikerId);

        // execute query
        $stmt->execute();

        return $stmt;


    }




    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                gebruikerId=:gebruikerId, alarmdataId=:alarmdataId";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->gebruikerId=htmlspecialchars(strip_tags($this->gebruikerId));
        $this->alarmdataId=htmlspecialchars(strip_tags($this->alarmdataId));


        // bind values
        $stmt->bindParam(":gebruikerId", $this->gebruikerId);
        $stmt->bindParam(":alarmdataId", $this->alarmdataId);



        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }


    function delete(){

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE  gebruikerId=:gebruikerId AND alarmdataId =:alarmdataId";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->gebruikerId=htmlspecialchars(strip_tags($this->gebruikerId));
        $this->alarmdataId=htmlspecialchars(strip_tags($this->alarmdataId));


        // bind values
        $stmt->bindParam(":gebruikerId", $this->gebruikerId);
        $stmt->bindParam(":alarmdataId", $this->alarmdataId);



        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }


}