<?php
/**
 * Created by PhpStorm.
 * User: Rory
 * Date: 10/03/2019
 * Time: 18:12
 */

 /**
  * Class that represent a user, with attributes relating to the user
  */
class User
{
	private $conn;

	public $userId;
	public $email;
	public $password;
	public $role;

	public function __construct(Database $conn)
	{
		$this->conn = $conn;
	}

	public function emailExists() {
		$this->conn->query("SELECT userId, firstName, lastName, password, role FROM User WHERE email = :email LIMIT 0, 1");

		$this->email = htmlspecialchars(strip_tags($this->email));
		$this->conn->bind(':email', $this->email);
		$this->conn->execute();
		$numRows = $this->conn->rowCount();

		if ($numRows > 0) {
			$row = $this->conn->single();

			$this->userId = $row['userId'];
			$this->password = $row['password'];
			$this->role = $row['role'];

			return true;
		}

		return false;
	}
}
