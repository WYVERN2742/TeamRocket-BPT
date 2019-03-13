<?php
/**
 * Created by PhpStorm.
 * User: Rory
 * Date: 10/03/2019
 * Time: 18:12
 */

class User {

	private $conn;

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

}
