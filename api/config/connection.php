<?php 
    
    class Database {
        // specify your own database credentials
        private $host = "localhost";
        private $db_name = "testdb";
        private $username = "teamrocketpi";
        private $password = "teamrocket";
        public $conn;
        function __contruct(){

        }
        public function getConnection(){
            $this->conn = null;

            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";port=3306;dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
                echo "success";

            }catch(PDOException $exception){
                echo("Connection error: ". $exception->getMessage());
            }

        }
    }
    $database = new Database();
    $db = $database->getConnection();
    
?>
