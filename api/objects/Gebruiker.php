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
        $stmt->bindParam(":wachtwoord", $this->wachtwoord);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telefoonnummer", $this->telefoonnummer);


        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }
}
