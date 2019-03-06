<?php
class Procurement{

    //database connection
    private $conn;
    private $table_name = "testTable";

    //object properties
    public $id;
    public $random;

    public function __construct($db){
        $this->conn = $db;
    }
}
?>