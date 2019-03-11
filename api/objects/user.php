<?php
/**
 * Created by PhpStorm.
 * User: Rory
 * Date: 10/03/2019
 * Time: 18:12
 */

class User {

	private $conn;
	private $table_name = "users";

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function login($id, $password) {
		$this->conn->query("SELECT * FROM user WHERE user_id=:id");

		//Maybe do something with $id?

		$this->conn->bind(":id", $id);

		$row = $this->conn->single();

		if ($this->conn->rowCount() > 0) {
			if (password_verify($password, $row["password"])) {
				return $id;
			}
		}

		return null;
	}

}
