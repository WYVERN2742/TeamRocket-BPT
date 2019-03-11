<?php
	//used the and modified code from tutorial
	class Database {
		// specify your own database credentials
		private $host = "localhost";
		private $db_name = "TRPT";
		private $username = "teamrocketuser";
		private $password = "teamrocket";

		private $conn;
		private $error;
		private $stmt;

		/**
		 * Creates a new database connection.
		 */
		public function __construct(){
			$this->conn = null;

			try{
				$this->conn = new PDO("mysql:host=" . $this->host . ";port=3306;dbname=" . $this->db_name, $this->username, $this->password);
				$this->conn->exec("set names utf8");
			}catch(PDOException $e){
				$this->error = $e->getMessage();
			}
		}

		/**
		 * Creates a new query to be executed.
		 * @param $query The query to be executed
		 */
		public function query($query) {
			$this->stmt = $this->conn->prepare($query);
		}

		/**
		 * Binds a parameter to the statement being prepared.
		 * @param $param The parameter to bind a value to
		 * @param $value The value to be bound to a parameter
		 * @param null $type The type of the value
		 */
		public function bind($param, $value, $type = null) {
			if (is_null($type)) {
				switch (true) {
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
				}
			}

			$this->stmt->bindValue($param, $value, $type);
		}

		/**
		 * Executes the prepared statement and .
		 * @return mixed
		 */
		public function execute() {
			return $this->stmt->execute();
		}

		public function resultSet() {
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function single() {
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_ASSOC);
		}

		public function rowCount() {
			return $this->stmt->rowCount();
		}

		public function beginTransaction() {
			return $this->conn->beginTransaction();
		}

		public function endTransaction() {
			return $this->conn->commit();
		}

		public function cancelTransaction() {
			return $this->conn->rollBack();
		}

	}
?>
