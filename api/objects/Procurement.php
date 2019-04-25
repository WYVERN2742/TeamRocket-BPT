<?php
/**
 * Provides database functions related to procurements.
 */
class Procurement {

	//database connection
	private $db;

	/**
	 * Procurement constructor.
	 * @param $db
	 */
	public function __construct($db) {
		$this->db = $db;
	}

	/**
	 * Returns all procurement requests where the requestor is the provided user ID
	 *
	 * @param String $userID
	 * @return resultSet list of requests
	 */
	public function getAllProcurements($userID) {
		$this->db->query("SELECT * FROM Procurement WHERE requesterId = :requesterId");
		$this->db->bind(":requesterId", $userID);
		$rs = $this->db->resultSet();
		return $rs;
	}

	/**
	 * Returns all information about a procurement request with a given id.
	 */
	public function readOne($procurementId) {
		/*$query = "SELECT * FROM " . $this->tableName . " WHERE requesterId = :id";
		$this->db->query($query);
		$this->db->bind(":id", $procurementId, PDO::PARAM_INT);

		return $this->db->single();*/

	}

	public function insert($budgetCode, $requesterId, $status, $recurring, $supplierId) {
		$this->db->query("INSERT INTO Procurement (budgetCode, requesterId, status, recurring, supplierId) VALUES (:budgetCode, :requesterId, :status, :recurring, :supplierId)");
		$this->db->bind(':budgetCode', $budgetCode);
		$this->db->bind(':requesterId', $requesterId);
		$this->db->bind(':status', $status);
		$this->db->bind(':recurring', $recurring);
		$this->db->bind(':supplierId', $supplierId);

		return $this->db->execute();
	}

	public function edit($budgetCode, $requesterId, $date, $status, $declineReason, $recurring, $supplierId, $procurementId) {
		$this->db->query("UPDATE Procurement SET budgetCode=:budgetCode, requesterId=:requesterId, status=:status, declineReason=:declineReason, recurring=:recurring, supplierId=:supplierId) WHERE procurementId=:procurementId");
		$this->db->bind(':budgetCode', $budgetCode);
		$this->db->bind(':requesterId', $requesterId);
		$this->db->bind(':status', $status);
		$this->db->bind(':declineReason', $declineReason);
		$this->db->bind(':recurring', $recurring);
		$this->db->bind(':supplierId', $supplierId);

		return $this->db->execute();
	}

	public function changeState($procurementId, $state) {
		$this->db->query("UPDATE Procurement SET status=:state WHERE procurementId=:procurementId");
		$this->db->bind(":state", $state);
		$this->db->bind(":procurementId", $procurementId);

		return $this->db->execute();
	}

	public function insertedProcurementId(){
		$this->db->query("SELECT LAST_INSERT_ID() AS procurementId");
		return $this->db->single();
	}

	public function insertItem($itemNumber, $procurementId, $name, $price, $quantity){
		$this->db->query("INSERT INTO Item (itemNumber, procurementId, name, price, quantity) VALUES (:itemNumber, :procurementId, :name, :price, :quantity)");
		$this->db->bind(":itemNumber", $itemNumber);
		$this->db->bind(":procurementId", $procurementId);
		$this->db->bind(":name", $name);
		$this->db->bind(":price", $price);
		$this->db->bind(":quantity", $quantity);

		return $this->db->execute();
	}

	public function getRequestInfo($procurementId){
		$this->db->query("SELECT * FROM Procurement WHERE procurementId = :procurementId");
		$this->db->bind(":procurementId", $procurementId);
		return $this->db->resultSet();
	}

	public function getRequestItems($procurementId){
		$this->db->query("SELECT * FROM Item WHERE procurementId = :procurementId");
		$this->db->bind(":procurementId", $procurementId);
		return $this->db->resultSet();
	}

	public function getSupplierInfo($procurementId){
		$this->db->query("SELECT * FROM Supplier s WHERE s.supplierId = (SELECT p.supplierId FROM Procurement p WHERE procurementId = :procurementId)");
		$this->db->bind(":procurementId", $procurementId);
		return $this->db->resultSet();
	}

	public function delete($procurementId) {

	}

}
