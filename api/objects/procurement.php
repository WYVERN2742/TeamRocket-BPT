<?php
class Procurement{

	//database connection
	private $conn;
	private $tableName = "Procurement";

	//object properties
	private $procurementId;
	private $budgetCode;
	private $requesterId = 500;

	public function __construct($db){
		$this->conn = $db;
		//$this->$requesterId = $passedID;
	}

	//read procurements
	function read(){
		$query = "SELECT * FROM " . $this->tableName . " WHERE requesterId = :id";
		$this->conn->query($query);

		$this->conn->bind(":id", $this->requesterId, PDO::PARAM_INT); 

		$stmt = $this->conn->execute();

		return $stmt;
	}	
}
?>
