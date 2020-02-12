<?php
class vat{

    // database connection and table name
    private $conn;
    private $table_name = "Vat";

    // object properties
    public $id;
    public $materiaalId;
    public $nummer;
    public $inGebruik;
    public $gelinkt;
    public $locatie;
    public $volume;
    public $mangat;
    public $deksel;
    public $koelmantel;





    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // select all query
        $query = "SELECT
               v.id, v.nummer,v.inGebruik, v.locatie, v.materiaalId, v.gelinkt, v.volume, v.mangat, v.deksel, v.koelmantel
            FROM
                " . $this->table_name . " v";

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
                nummer= :nummer, inGebruik= :inGebruik, gelinkt= :gelinkt, locatie= :locatie, materiaalId= :materiaalId, volume= :volume, mangat= :mangat, deksel= :deksel, koelmantel= :koelmantel";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nummer=htmlspecialchars(strip_tags($this->nummer));
        $this->inGebruik=htmlspecialchars(strip_tags($this->inGebruik));
        $this->gelinkt=htmlspecialchars(strip_tags($this->gelinkt));
        $this->locatie=htmlspecialchars(strip_tags($this->locatie));
        $this->materiaalId=htmlspecialchars(strip_tags($this->materiaalId));
        $this->volume=htmlspecialchars(strip_tags($this->volume));
        $this->mangat=htmlspecialchars(strip_tags($this->mangat));
        $this->deksel=htmlspecialchars(strip_tags($this->deksel));
        $this->koelmantel=htmlspecialchars(strip_tags($this->koelmantel));





        // bind values
        $stmt->bindParam(":nummer", $this->nummer);
        $stmt->bindParam(":inGebruik", $this->inGebruik);
        $stmt->bindParam(":gelinkt", $this->gelinkt);
        $stmt->bindParam(":locatie", $this->locatie);
        $stmt->bindParam(":materiaalId", $this->materiaalId);
        $stmt->bindParam(":volume", $this->volume);
        $stmt->bindParam(":mangat", $this->mangat);
        $stmt->bindParam(":deksel", $this->deksel);
        $stmt->bindParam(":koelmantel", $this->koelmantel);


        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }


    function readOne(){

        // query to read single record
        $query = "SELECT
                v.id, v.nummer, v.inGebruik, v.locatie, v.materiaalId, v.gelinkt, v.volume, v.mangat, v.deksel, v.koelmantel
            FROM
                " . $this->table_name . " v
           
            WHERE
                v.id = ?
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
        $this->locatie = $row['locatie'];
        $this->materiaalId = $row['materiaalId'];
        $this->gelinkt = $row['gelinkt'];
        $this->volume = $row['volume'];
        $this->deksel = $row['deksel'];
        $this->koelmantel = $row['koelmantel'];
        $this->mangat = $row['mangat'];


    }


    function update(){


        $query = "UPDATE
                " . $this->table_name . "
            SET
                  nummer= :nummer, inGebruik= :inGebruik, gelinkt= :gelinkt, locatie= :locatie, materiaalId= :materiaalId, volume= :volume, mangat= :mangat, deksel= :deksel, koelmantel= :koelmantel

                
              
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nummer=htmlspecialchars(strip_tags($this->nummer));
        $this->inGebruik=htmlspecialchars(strip_tags($this->inGebruik));
        $this->gelinkt=htmlspecialchars(strip_tags($this->gelinkt));
        $this->locatie=htmlspecialchars(strip_tags($this->locatie));
        $this->materiaalId=htmlspecialchars(strip_tags($this->materiaalId));
        $this->volume=htmlspecialchars(strip_tags($this->volume));
        $this->mangat=htmlspecialchars(strip_tags($this->mangat));
        $this->deksel=htmlspecialchars(strip_tags($this->deksel));
        $this->koelmantel=htmlspecialchars(strip_tags($this->koelmantel));


        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(":nummer", $this->nummer);
        $stmt->bindParam(":inGebruik", $this->inGebruik);
        $stmt->bindParam(":gelinkt", $this->gelinkt);
        $stmt->bindParam(":locatie", $this->locatie);
        $stmt->bindParam(":materiaalId", $this->materiaalId);
        $stmt->bindParam(":volume", $this->volume);
        $stmt->bindParam(":mangat", $this->mangat);
        $stmt->bindParam(":deksel", $this->deksel);
        $stmt->bindParam(":koelmantel", $this->koelmantel);

        $stmt->bindParam(':id', $this->id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
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



}
?>