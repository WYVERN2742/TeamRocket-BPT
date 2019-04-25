<?php
/**
 * Created by PhpStorm.
 * User: Rory
 * Date: 11/03/2019
 * Time: 21:47
 */

 /**
  * Provides database functions related specifically to administration of
  * users and data.
  */
class Admin {

	//database connection
	private $db;

	/**
	* Central finance constructor.
	* @param $db
	*/
	public function __construct($db) {
		$this->db = $db;
	}


	/**
	 * List of all users and info in the database
	 *
	 * @return resultSet set of users
	 */
	public function getAllUsers() {
		$this->db->query("SELECT userId, firstName, lastName, role, roomNo, telephoneNo, email FROM User");
		//all users in the database.
		$rs = $this->db->resultSet();
		return $rs;
	}

	/**
	 * Get User with the provided email
	 *
	 * @param String $email Email of user
	 * @return mixed info of single user
	 */
	public function getUserFromEmail($email){
		$this->db->query("SELECT userId, firstName, lastName, role, roomNo, telephoneNo, email FROM User WHERE email = :email");
		$this->db->bind(":email", $email);

		$rs = $this->db->single();
		return $rs;
	}

	/**
	 * Get all emails of procurement officers
	 *
	 * @return resultSet List of officer emails
	 */
	public function getProcurementOfficerEmails(){
		$this->db->query("SELECT email, role FROM User WHERE role = \"REQUISITION_OFFICER\"");
		$rs = $this->db->resultSet();
		return $rs;
	}

	/**
	 * List of all emails.
	 *
	 * @return resultSet set of all user emails
	 */
	public function getAllUserEmails(){
		$this->db->query("SELECT email FROM User");
		$rs = $this->db->resultSet();
		return $rs;
	}

	/**
	 * Info of one user.
	 *
	 * @param String $userId
	 * @return mixed info of single user
	 */
	public function getUser($userId) {
		$this->db->query("SELECT userId, firstName, lastName, role, roomNo, telephoneNo, email FROM User WHERE userId=:userId");
		// all users in the database.
		$this->db->bind(":userId", $userId);
		$rs = $this->db->single();
		return $rs;
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

	public function viewAllBudgetCodes() {
		$this->db->query("SELECT budgetCode, ownerId, procurementOfficer FROM BudgetCode");
		$rs = $this->db->resultSet();
		return $rs;
	}

	/**
	 * Return a full list of budget codes and the owners as email addresses
	 *
	 * @return ResultSet
	 */
	public function viewAllBudgetCodesEmail() {

	}

	public function viewBudgetCode($budgetCode) {
		$this->db->query("SELECT budgetCode, ownerId, procurementOfficer FROM BudgetCode WHERE budgetCode=:budgetCode");
		$this->db->bind(":budgetCode", $budgetCode);
		$rs = $this->db->single();
		return $rs;
	}

	public function createBudgetCode($budgetCode, $ownerId, $procurementOfficer) {
		$this->db->query("INSERT INTO BudgetCode(budgetCode, ownerId, procurementOfficer) VALUES (:budgetCode, :ownerId, :procurementOfficer)");
		$this->db->bind(":budgetCode", $budgetCode);
		$this->db->bind(":ownerId", $ownerId);
		$this->db->bind(":procurementOfficer", $procurementOfficer);

		return $this->db->execute();
	}

	public function editBudgetCode($ownerId, $procurementOfficer) {
		$this->db->query("UPDATE BudgetCode SET ownerId=:ownerId, procurementOfficer=:procurementOfficer WHERE budgetCode=:budgetCode");
		$this->db->bind(":ownerId", $ownerId);
		$this->db->bind(":procurementOfficer", $procurementOfficer);

		return $this->db->execute();
	}

	public function getBudgetCodeOwner($budgetCode) {
		$this->db->query("SELECT firstName, lastName, roomNo, telephoneNo, email FROM User WHERE userId = (SELECT ownerId FROM BudgetCode WHERE budgetCode = :budgetCode) LIMIT 0, 1");
		$this->db->bind("budgetCode", $budgetCode);
		$rs = $this->db->single();
		return $rs;
	}

	public function getError() {
		return $this->db->getError();
	}
}
