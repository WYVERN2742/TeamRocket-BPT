<?php
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

	/**
	 * Inserts a new user into the User table.
	 *
	 * @param String $password Password
	 * @param String $firstName First Name
	 * @param String $lastName Last Name
	 * @param String $role Role, role the user holds in the system
	 * @param int $roomNo Room number
	 * @param String $telephoneNo Telephone number
	 * @param String $email Email
	 * @return bool A return of true means execution was successful
	 */
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

	/**
	 * Deletes a user from the User table.
	 *
	 * @param int $userId User ID
	 * @return bool A return of true means execution was successful
	 */
	public function removeUser($userId) {
		$this->db->query("DELETE FROM User WHERE userId = :userId");
		$this->db->bind(":userId", $userId);

		return $this->db->execute();
	}

	/**
	 * Updates an existing users information in the User table.
	 *
	 * @param int $userId User ID
	 * @param String $firstName First Name
	 * @param String $lastName Last Name
	 * @param String $role Role, role the user holds in the system
	 * @param int $roomNo Room number
	 * @param String $telephoneNo Telephone number
	 * @param String $email Email
	 * @return bool A return of true means execution was successful
	 */
	public function editUser($userId, $firstName, $lastName, $role, $roomNo, $telephoneNo, $email) {
		$this->db->query("UPDATE User SET firstName=:firstName, lastName=:lastName, role=:role, roomNo=:roomNo, telephoneNo=:telephoneNo, email=:email WHERE userId=:userId");
		$this->db->bind(":userId", $userId);
		$this->db->bind(":firstName", $firstName);
		$this->db->bind(":lastName", $lastName);
		$this->db->bind(":role", $role);
		$this->db->bind(":roomNo", $roomNo);
		$this->db->bind(":telephoneNo", $telephoneNo);
		$this->db->bind(":email", $email);

		return $this->db->execute();
	}

	/**
	 * Changes the password for an existing user in the User table.
	 *
	 * @param int $userId User ID
	 * @param String $password Password
	 * @return bool return of true means execution was successful
	 */
	public function changePassword($userId, $password){
		$this->db->query("UPDATE User SET password = :password WHERE userId = :userId");
		$this->db->bind(":password", $password);
		$this->db->bind(":userId", $userId);

		return $this->db->execute();
	}

	/**
	 * Returns a result set of all budget codes in the BudgetCode table.
	 *
	 * @return array $rs is an array of rows returned from the SQL query
	 */
	public function viewAllBudgetCodes() {
		$this->db->query("SELECT budgetCode, ownerId, procurementOfficer FROM BudgetCode");
		$rs = $this->db->resultSet();
		return $rs;
	}

	/**
	 * Returns information for a specified budget code
	 *
	 * @param String $budgetCode Budget code
	 * @return array $rs is an array containing a single row from the SQL query
	 */
	public function viewBudgetCode($budgetCode) {
		$this->db->query("SELECT budgetCode, ownerId, procurementOfficer FROM BudgetCode WHERE budgetCode=:budgetCode");
		$this->db->bind(":budgetCode", $budgetCode);
		$rs = $this->db->single();
		return $rs;
	}

	/**
	 * Inserts a new budget code into the BudgetCode table.
	 *
	 * @param String $budgetCode Budget code
	 * @param int $ownerId Owner ID
	 * @param int $procurementOfficer Procurement Officer (otherwise known as a requisition officer)
	 * @return bool return of true means execution was successful
	 */
	public function createBudgetCode($budgetCode, $ownerId, $procurementOfficer) {
		$this->db->query("INSERT INTO BudgetCode(budgetCode, ownerId, procurementOfficer) VALUES (:budgetCode, :ownerId, :procurementOfficer)");
		$this->db->bind(":budgetCode", $budgetCode);
		$this->db->bind(":ownerId", $ownerId);
		$this->db->bind(":procurementOfficer", $procurementOfficer);

		return $this->db->execute();
	}

	/**
	 * Updates the information of an existing budget code in the BudgetCode table.
	 *
	 * @param String $budgetCode Budget code, the original budget code.
	 * @param String $newBudgetCode New budget code, the new budget code value
	 * @param int $ownerId Owner ID
	 * @param int $procurementOfficer Procurement Officer (otherwise known as a requisition officer)
	 * @return bool return of true means execution was successful
	 */
	public function editBudgetCode($budgetCode, $newBudgetCode, $ownerId, $procurementOfficer) {
		$this->db->query("UPDATE BudgetCode SET budgetCode = :newBudgetCode, ownerId=:ownerId, procurementOfficer=:procurementOfficer WHERE budgetCode=:budgetCode");
		$this->db->bind(":ownerId", $ownerId);
		$this->db->bind(":procurementOfficer", $procurementOfficer);
		$this->db->bind(":budgetCode", $budgetCode);
		$this->db->bind(":newBudgetCode", $newBudgetCode);

		return $this->db->execute();
	}

	/**
	 * Gets the user information about a budget code owner for a specified budget code.
	 *
	 * @param String $budgetCode
	 * @return array $rs is an array containing a single row from the SQL query
	 */
	public function getBudgetCodeOwner($budgetCode) {
		$this->db->query("SELECT firstName, lastName, roomNo, telephoneNo, email FROM User WHERE userId = (SELECT ownerId FROM BudgetCode WHERE budgetCode = :budgetCode) LIMIT 0, 1");
		$this->db->bind("budgetCode", $budgetCode);
		$rs = $this->db->single();
		return $rs;
	}

	/**
	 * Gets the user information about a budget code owner for a specified budget code.
	 *
	 * @param String $budgetCode
	 * @return array $rs is an array containing a single row from the SQL query
	 */
	public function getBudgetCodeOfficer($budgetCode) {
		$this->db->query("SELECT firstName, lastName, roomNo, telephoneNo, email FROM User WHERE userId = (SELECT procurementOfficer FROM BudgetCode WHERE budgetCode = :budgetCode) LIMIT 0, 1");
		$this->db->bind("budgetCode", $budgetCode);
		$rs = $this->db->single();
		return $rs;
	}


	/**
	 * Gets the budget code with the emails for the owner and procurement officer.
	 *
	 * @return array Returns an array of rows returned from the SQL query
	 */
	public function getBudgetCodeEmails(){
		$this->db->query("SELECT budgetCode, (SELECT email FROM User WHERE userId = ownerId) AS ownerEmail, (SELECT email FROM User WHERE userId = procurementOfficer) AS procurementOfficerEmail FROM BudgetCode");
		return $this->db->resultSet();
	}

	/**
	 * Deletes a the passed budget code from the BudgetCode table.
	 *
	 * @param String $budgetCode Budget code
	 * @return bool return of true means execution was successful
	 */
	public function removeBudgetCode($budgetCode){
		$this->db->query("DELETE FROM BudgetCode WHERE budgetCode = :budgetCode");
		$this->db->bind(":budgetCode", $budgetCode);

		return $this->db->execute();
	}

	/**
	 * Returns the error message for the last operation. Implemented for debugging purposes.
	 *
	 * @return String Error message.
	 */
	public function getError() {
		return $this->db->getError();
	}
}
