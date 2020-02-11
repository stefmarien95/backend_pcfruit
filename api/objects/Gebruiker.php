<?php


class Gebruiker
{
    // database connection and table name
    private $conn;
    private $table_name = "Gebruiker";

    // object properties
    public $id;
    public $rolId;
    public $voornaam;
    public $naam;
    public $gebruikersnaam;
    public $wachtwoord;
    public $email;
    public $telefoonnummer;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // select all query
        $query = "SELECT
               g.id,g.rolId,g.voornaam,g.naam,g.gebruikersnaam,g.wachtwoord,g.email,g.telefoonnummer
            FROM
                " . $this->table_name . " g
                 LEFT JOIN
                    Rol r
                        ON  g.rolId= r.id"
        ;


        $stmt = $this->conn->prepare($query);


        $stmt->execute();

        return $stmt;
    }

    function readOne(){

        $query = "SELECT
                g.id,g.rolId,g.voornaam,g.naam,g.gebruikersnaam,g.wachtwoord,g.email,g.telefoonnummer
            FROM
                " . $this->table_name . " g
           
            WHERE
                g.email = ? AND g.wachtwoord = ?
            LIMIT
                0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->wachtwoord);
        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->id = $row['id'];
        $this->rolId = $row['rolId'];
        $this->voornaam = $row['voornaam'];
        $this->naam = $row['naam'];
        $this->gebruikersnaam = $row['gebruikersnaam'];
        $this->email = $row['email'];
        $this->telefoonnummer = $row['telefoonnummer'];



    }


    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                rolId=:rolId, voornaam=:voornaam, naam=:naam, gebruikersnaam=:gebruikersnaam, wachtwoord=:wachtwoord, email=:email, telefoonnummer=:telefoonnummer";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->rolId=htmlspecialchars(strip_tags($this->rolId));
        $this->voornaam=htmlspecialchars(strip_tags($this->voornaam));
        $this->naam=htmlspecialchars(strip_tags($this->naam));
        $this->gebruikersnaam=htmlspecialchars(strip_tags($this->gebruikersnaam));
        $this->wachtwoord=htmlspecialchars(strip_tags($this->wachtwoord));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->telefoonnummer=htmlspecialchars(strip_tags($this->telefoonnummer));



        // bind values
        $stmt->bindParam(":rolId", $this->rolId);
        $stmt->bindParam(":voornaam", $this->voornaam);
        $stmt->bindParam(":naam", $this->naam);
        $stmt->bindParam(":gebruikersnaam", $this->gebruikersnaam);
        //$password_hash = password_hash($this->wachtwoord, PASSWORD_BCRYPT);
        //$stmt->bindParam(':wachtwoord', $password_hash);
        $stmt->bindParam(":wachtwoord", $this->wachtwoord);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telefoonnummer", $this->telefoonnummer);


        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }

    // check if given email exist in the database
    function emailExists(){

        // query to check if email exists
        $query = "SELECT id, rolId, voornaam, naam, gebruikersnaam, wachtwoord, telefoonnummer
            FROM " . $this->table_name . "
            WHERE email = ?
            LIMIT 0,1";

        // prepare the query
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));

        // bind given email value
        $stmt->bindParam(1, $this->email);

        // execute the query
        $stmt->execute();

        // get number of rows
        $num = $stmt->rowCount();

        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){

            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // assign values to object properties
            $this->id = $row['id'];
            $this->rolId = $row['rolId'];
            $this->voornaam = $row['voornaam'];
            $this->naam = $row['naam'];
            $this->gebruikersnaam = $row['gebruikersnaam'];
            $this->wachtwoord = $row['wachtwoord'];
            $this->telefoonnummer = $row['telefoonnummer'];

            // return true because email exists in the database
            return true;
        }

        // return false if email does not exist in the database
        return false;
    }
}
