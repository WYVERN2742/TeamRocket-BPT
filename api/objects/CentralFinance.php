<?php
/**
 * Created by PhpStorm.
 * User: Rory
 * Date: 11/03/2019
 * Time: 21:47
 */

class CentralFinance extends User {
    
    //database connection
    private $db;

    /**
	* Central finance constructor.
	* @param $db
	*/
    public function __construct($db){
        $this->db = $db;
    }

    public function addUser($password, $firstName, $lastName, $role, $roomNo, $telephoneNo, $email) {

        try{
            $this->db->query("INSERT INTO User(password, firstName, lastName, role, roomNo, telephone, email) VALUES (:password, :firstName, :lastName, :role, :roomNo, :telephoneNo, :email)");
            $this->db->bind(":password", $password); 
            $this->db->bind(":firstName", $firstName);
            $this->db->bind(":lastName", $lastName);
            $this->db->bind(":role", $role);
            $this->db->bind(":roomNo", $roomNo);
            $this->db->bind(":telephoneNo", $telephoneNo);

            $this->db->execute();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }

    }

    public function removeUser($userId) {
        try{
            $this->db->query("DELETE FROM User WHERE userId = :userId");
            $this->db->bind(":userId", $userId);
            
            $this->db->execute();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function editUser($userId) {
        try{
            $str = "UPDATE User SET = ";
            $this->db->query($str);
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function createBudgetCode() {

    }

    public function viewUsers() {
        $this->db->query("SELECT userId, firstName, lastName, role, roomNo, telephoneNo, email FROM User"); //all users in the database.
		$this->db->execute();
		$rs = $this->db->resultSet();
		return $rs;
    }

    public function viewBudgetCodes() {

    }

}