<?php
/**
 * Created by PhpStorm.
 * User: Rory
 * Date: 11/03/2019
 * Time: 21:47
 */

class CentralFinance {

	//database connection
	private $db;

	/**
	* Central finance constructor.
	* @param $db
	*/
	public function __construct($db) {
		$this->db = $db;
	}

	public function addUser($password, $firstName, $lastName, $role, $roomNo, $telephoneNo, $email) {
		$this->db->query("INSERT INTO User(password, firstName, lastName, role, roomNo, telephoneNo, email) VALUES (:password, :firstName, :lastName, :role, :roomNo, :telephoneNo, :email)");

		$this->db->bind(":password", $password);
		$this->db->bind(":firstName", $firstName);
		$this->db->bind(":lastName", $lastName);
		$this->db->bind(":role", $role);
		$this->db->bind(":roomNo", $roomNo);
		$this->db->bind(":telephoneNo", $telephoneNo);
		$this->db->bind(":email", $email);
		return $this->db->execute();
	}

	public function getError() {
		return $this->db->getError();
	}

	public function removeUser($userId) {
		$this->db->query("DELETE FROM User WHERE userId = :userId");
		$this->db->bind(":userId", $userId);

		return $this->db->execute();
	}

	public function editUser($userId, $password, $firstName, $lastName, $role, $roomNo, $telephoneNo, $email) {
		$this->db->query("UPDATE User SET password=:password, firstName=:firstName, lastName=:lastName, role=:role, roomNo=:roomNo, telephoneNo=:telephoneNo, email=:email WHERE userId=:userId");
		$this->db->bind(":userId", $userId);
		$this->db->bind(":password", $password);
		$this->db->bind(":firstName", $firstName);
		$this->db->bind(":lastName", $lastName);
		$this->db->bind(":role", $role);
		$this->db->bind(":roomNo", $roomNo);
		$this->db->bind(":telephoneNo", $telephoneNo);
		$this->db->bind(":email", $email);

		return $this->db->execute();
	}

	public function createBudgetCode($budgetCode, $ownerId, $procurementOfficer) {
		$this->db->query("INSERT INTO BudgetCode(budgetCode, ownerId, procurementOfficer) VALUES (:budgetCode, :ownerId, :procurementOfficer)");
		$this->db->bind(":budgetCode", $budgetCode);
		$this->db->bind(":ownerId", $ownerId);
		$this->db->bind(":procurementOfficer", $procurementOfficer);

		return $this->db->execute();
	}

	public function updateBudgetCode($ownerId, $procurementOfficer) {
		$this->db->query("UPDATE BudgetCode SET ownerId=:ownerId, procurementOfficer=:procurementOfficer WHERE budgetCode=:budgetCode");
		$this->db->bind(":ownerId", $ownerId);
		$this->db->bind(":procurementOfficer", $procurementOfficer);

		return $this->db->execute();
	}

	public function viewUsers() {
		$this->db->query("SELECT userId, firstName, lastName, role, roomNo, telephoneNo, email FROM User"); //all users in the database.
		$rs = $this->db->resultSet();
		return $rs;
	}

	public function viewUser($userId) {
		$this->db->query("SELECT userId, firstName, lastName, role, roomNo, telephoneNo, email FROM User WHERE userId=:userId"); //all users in the database.
		$this->db->bind(":userId", $userId);
		$rs = $this->db->single();
		return $rs;
	}

	public function viewBudgetCodes() {
		$this->db->query("SELECT budgetCode, ownerId, procurementOfficer FROM BudgetCode");
		$rs = $this->db->resultSet();
		return $rs;
	}

	public function viewBudgetCode($budgetCode) {
		$this->db->query("SELECT budgetCode, ownerId, procurementOfficer FROM BudgetCode WHERE budgetCode=:budgetCode");
		$this->db->bind(":budgetCode", $budgetCode);
		$rs = $this->db->single();
		return $rs;
	}

	public function getBudgetCodeOwner($budgetCode) {
		$this->db->query("SELECT firstName, lastName, roomNo, telephoneNo, email FROM User WHERE userId = (SELECT ownerId FROM BudgetCode WHERE budgetCode = :budgetCode) LIMIT 0, 1");
		$this->db->bind("budgetCode", $budgetCode);
		$rs = $this->db->single();
		return $rs;
	}
}
