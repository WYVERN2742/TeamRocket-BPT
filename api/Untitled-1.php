<?php 
    
    class Database {
        // specify your own database credentials
        private $host = "192.168.0.19";
        private $db_name = "testdb";
        private $username = "teamrocketpi";
        private $password = "teamrocket";
        public $conn;
        function __contruct(){

        }
        public function getConnection(){
            $this->conn = null;

            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");

            }catch(PDOException $exception){
                echo("Connection error: ". $exception->getMessage());
            }

        }
    }
    $database = new Database();
    $db = $database->getConnection();
    
?>