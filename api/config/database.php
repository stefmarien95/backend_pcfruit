
<?php
class Database{


    private $host = "192.168.0.105";
    private $db_name = "wijn";
    private $username = "admin";
    private $password = "breakers";
    public $conn;

    /*
    private $host = "localhost";
    private $db_name = "api_db";
    private $username = "root";
    private $password = "mysql";
    public $conn;
    */

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>