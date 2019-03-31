<?php
/**
 * Created by PhpStorm.
 * User: Rory
 * Date: 10/03/2019
 * Time: 18:12
 */

class User {

	private $conn;

	public $userId;
	public $email;
	public $password;
	public $role;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	/**
	 * @param $email
	 * @param $password
	 * @return int|null
	 */
	public function login($email, $password) {
		if ($email == "test@test.com" && $password == "test") {
			return 1;
		}

		return null;
	}

	public function emailExists() {
		$this->conn->query("SELECT userId, firstName, lastName, password, role FROM User WHERE email = :email LIMIT 0,1");

		$this->email = htmlspecialchars(strip_tags($this->email));
		$this->conn->bind(':email', $this->email);
		$this->conn->execute();
		$numRows = $this->conn->rowCount();

		if ($numRows > 0) {
			$row = $this->conn->single();

			$this->userId = $row['userId'];
			$this->firstName = $row['firstName'];
			$this->lastName = $row['lastName'];
			$this->password = $row['password'];
			$this->role = $row['role'];

			return true;
		}

		return false;
	}

}
