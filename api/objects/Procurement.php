<?php
class Procurement{

	//database connection
	private $db;

	/**
	 * Procurement constructor.
	 * @param $db
	 */
	public function __construct($db){
		$this->db = $db;
	}

	public function readAll() {
		$this->db->query("SELECT * FROM Procurement WHERE requesterId = :requesterId");
		$this->db->bind(":requesterId", $_SESSION['user']);
		$this->db->execute();
		$rs = $this->db->resultSet();
		return $rs;
	}

	/**
	 * Returns all information about a procurement request with a given id.
	 */
	public function readOne($procurementId) {
		/*$query = "SELECT * FROM " . $this->tableName . " WHERE requesterId = :id";
		$this->conn->query($query);
		$this->conn->bind(":id", $procurementId, PDO::PARAM_INT);

		return $this->conn->single();*/

	}

	public function insert($budgetCode, $requesterID, $date, $status, $declineReason, $recurring, $supplierId) {
		$this->conn->query("INSERT INTO Procurement (budgetCode, requesterID, date, status, declineReason, recurring, supplierID) VALUES (:budgetCode, :requesterID, :date, :status, :declineReason, :recurring, :supplierID)");
		$this->conn->bind(':budgetCode', $budgetCode);
		$this->conn->bind(':requesterID', $requesterID);
		$this->conn->bind(':date', $date);
		$this->conn->bind(':status', $status);
		$this->conn->bind(':declineReason', $declineReason);
		$this->conn->bind(':recurring', $recurring);
		$this->conn->bind(':supplierID', $supplierId);
	}

	public function edit($budgetCode, $requesterID, $date, $status, $declineReason, $recurring, $supplierId) {

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
