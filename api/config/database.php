<?php
	//used the and modified code from tutorial
	class Database {
		// specify your own database credentials
		private $host = "192.168.0.19";
		private $db_name = "TRPT";
		private $username = "teamrocketuser";
		private $password = "teamrocket";
		public $conn;
		function __contruct(){

		}
		public function openConnection(){
			$this->conn = null;

			try{
				$this->conn = new PDO("mysql:host=" . $this->host . ";port=3306;dbname=" . $this->db_name, $this->username, $this->password);
				$this->conn->exec("set names utf8");

			}catch(PDOException $exception){
				echo("Connection error: ". $exception->getMessage());
			}

			return $this->conn;
		}

	}
?>
