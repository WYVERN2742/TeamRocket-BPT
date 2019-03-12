<?php
class Procurement{

	//database connection
	private $conn;

	/**
	 * Procurement constructor.
	 * @param $db
	 */
	public function __construct($db){
		$this->conn = $db;
	}

	/**
	 * Returns all information about a procurement request with a given id.
	 */
	public function read($procurementId) {
		/*$query = "SELECT * FROM " . $this->tableName . " WHERE requesterId = :id";
		$this->conn->query($query);
		$this->conn->bind(":id", $procurementId, PDO::PARAM_INT);

		return $this->conn->single();*/

	}

	public function insert($budgetCode, $date, $status, $recurring, $supplierId) {

	}

	public function edit($procurementId, $budgetCode, $date, $status, $recurring, $supplierId) {

	}

	public function delete($procurementId) {

	}

	public function approve($procurementId) {

	}

	public function decline($procurementId) {

	}

	public function resubmit($procurementId) {

	}
}
?>
