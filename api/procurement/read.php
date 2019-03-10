<?php
    //required headers define access and type of return
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    //database and object files
    include_once '../config/database.php';
    include_once '../objects/procurement.php';

    //instantiate database and open connection
    $database = new Database();
    $db = $database->openConnection();

    //initialize object
    $procurement = new procurement($db);

    //query procurements
    $stmt = $procurement->read();
    $num = $stmt->rowCount();

    //check if more than 0 records found
    if($num > 0){
        //procurement array
        $procurement_arr = array();
        $procurement_arr["records"] = array();

        //retrieve out table contents
        //fetch() is faster than fetchAll()
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //extract row
            //this will make $row['name'] to
            //just $name only
            extract($row);

            $procurement_item = array(
                "id" => $id,
                "random" => $random
            );

            array_push($procurement_arr["records"], $procurement_item);            
        }
    }
?>