<?php
class Procurement{

	//database connection
	private $conn;
	private $tableName = "testTable";

	//object properties
	public $id;
	public $random;

	public function __construct($db){
		$this->conn = $db;
	}

	//read procurements
	function read(){
		$query = "SELECT * FROM " . $this->tableName;

		$stmt = $this->conn->prepare($query);

		$stmt->execute();

		return $stmt;
	}	
}
?>
