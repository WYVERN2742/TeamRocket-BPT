<?php
class Procurement{

	//database connection
	private $conn;
	private $tableName = "Procurement";

	//object properties
	public $procurementId;
	public $budgetCode;
	public $requesterId;
	public $date;
	public $status;
	public $recurring;
	public $supplierId;

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
