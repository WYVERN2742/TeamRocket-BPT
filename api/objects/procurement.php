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

	public function __construct($db, $passedID = null){
		$this->conn = $db;
		$this->$requesterId = $passedID;
	}

	//read procurements
	function read(){
		$query = "SELECT * FROM " . $this->tableName;

		if($passedID != null){
			$query = $query . "WHERE requesterId = " . $this->$requesterId;
		}

		$stmt = $this->conn->prepare($query);

		$stmt->execute();

		return $stmt;
	}	
}
?>
