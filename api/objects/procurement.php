<?php
class Procurement{

    //database connection
    private $conn;
    private $tableName = "testTable";

    //object properties
    public $id;
    public $random;

    public function __construct($db){
        $this->conn = $db;
    }
}
?>
