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
		$this->db->query("SELECT p.*, (SELECT email FROM User u WHERE u.userId = requesterId) AS 'requesterEmail' FROM Procurement p WHERE p.requesterId = :requesterId OR p.budgetCode IN (SELECT b.budgetCode FROM BudgetCode b WHERE b.ownerId = :requesterId) OR p.budgetCode IN (SELECT b.budgetCode FROM BudgetCode b WHERE procurementOfficer = :requesterId) OR (status = 'BEFORE_FINANCE_APPROVAL' AND (SELECT role FROM User WHERE userId = :requesterId) = 'CENTRAL_FINANCE') ORDER BY `date` DESC");
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

	/**
	 * Inserts a new procurement request into the Procurement table. 
	 * 
	 * @param String $budgetCode Budget code
	 * @param int $requesterId Requester ID
	 * @param String $status Status must be a value from values ('DRAFT','BEFORE_BUDGET_APPROVAL','BEFORE_FINANCE_APPROVAL','BEFORE_REQ_APPROVAL','DONE','DECLINED')
	 * @param bool $recurring Recurring
	 * @param int $supplierId Supplier ID
	 * @return bool A return of true means execution was successful 
	 */
	public function insert($budgetCode, $requesterId, $status, $recurring, $supplierId) {
		$this->db->query("INSERT INTO Procurement (budgetCode, requesterId, status, recurring, supplierId) VALUES (:budgetCode, :requesterId, :status, :recurring, :supplierId)");
		$this->db->bind(':budgetCode', $budgetCode);
		$this->db->bind(':requesterId', $requesterId);
		$this->db->bind(':status', $status);
		$this->db->bind(':recurring', $recurring);
		$this->db->bind(':supplierId', $supplierId);

		return $this->db->execute();
	}

	/**
	 * Sets the reason for declining a procurement requests in the Procurement table. 
	 * 
	 * @param int $procurementId Procurement ID
	 * @param String $declineReason Decline reason
	 * @return bool A return of true means execution was successful 
	 */
	public function setDeclineReason($procurementId, $declineReason) {
		$this->db->query("UPDATE Procurement SET declineReason = :declineReason WHERE procurementId = :procurementId");
		$this->db->bind(":declineReason", $declineReason);
		$this->db->bind(":procurementId", $procurementId);

		return $this->db->execute();
	}

	/**
	 * Changes the state of a procurement request in the procurement table. 
	 * 
	 * @param int $procurementId Procurement ID
	 * @param String $state State must be a value from values ('DRAFT','BEFORE_BUDGET_APPROVAL','BEFORE_FINANCE_APPROVAL','BEFORE_REQ_APPROVAL','DONE','DECLINED')
	 * @return bool A return of true means execution was successful
	 */
	public function changeState($procurementId, $state) {
		$this->db->query("UPDATE Procurement SET status=:state WHERE procurementId=:procurementId");
		$this->db->bind(":state", $state);
		$this->db->bind(":procurementId", $procurementId);

		return $this->db->execute();
	}

	/**
	 * Get the ID of the last inserted procurement for the current connection.
	 * 
	 * @return array returns an array with a single row containing the procurement ID
	 */
	public function insertedProcurementId(){
		$this->db->query("SELECT LAST_INSERT_ID() AS procurementId");
		return $this->db->single();
	}

	/**
	 * Inserts an new item into the Item table for a procurement thats been submitted.
	 * 
	 * @param int $itemNumber Item number, the item number out of the collection of items being submitted
	 * @param int $procurementId Procurement ID
	 * @param String $name Name of the item
	 * @param double $price Price of the item
	 * @param int $quantity Quantity
	 * @return bool A return of true means execution was successful
	 */
	public function insertItem($itemNumber, $procurementId, $name, $price, $quantity){
		$this->db->query("INSERT INTO Item (itemNumber, procurementId, name, price, quantity) VALUES (:itemNumber, :procurementId, :name, :price, :quantity)");
		$this->db->bind(":itemNumber", $itemNumber);
		$this->db->bind(":procurementId", $procurementId);
		$this->db->bind(":name", $name);
		$this->db->bind(":price", $price);
		$this->db->bind(":quantity", $quantity);

		return $this->db->execute();
	}

	/**
	 * Returns a single result for a specified procurement.
	 * 
	 * @param int $procurementId Procurement ID
	 * @return array returns an array with a single row containing the procurement information
	 */
	public function getRequestInfo($procurementId){
		$this->db->query("SELECT * FROM Procurement WHERE procurementId = :procurementId");
		$this->db->bind(":procurementId", $procurementId);
		return $this->db->single();
	}

	/**
	 * Returns information about items for a specified procurement.
	 * 
	 * @param int $procurementId Procurement ID
	 * @return array returns an array containing the result rows
	 */
	public function getRequestItems($procurementId){
		$this->db->query("SELECT itemNumber, name, price, quantity FROM Item WHERE procurementId = :procurementId");
		$this->db->bind(":procurementId", $procurementId);
		return $this->db->resultSet();
	}

	/**
	 * Returns the supplier information for a specified procurement.
	 * 
	 * @param int $procurementId Procurement ID
	 * @return array returns an array containing the result rows
	 */
	public function getSupplierInfo($procurementId){
		$this->db->query("SELECT * FROM Supplier s WHERE s.supplierId = (SELECT p.supplierId FROM Procurement p WHERE procurementId = :procurementId)");
		$this->db->bind(":procurementId", $procurementId);
		return $this->db->single();
	}
}
