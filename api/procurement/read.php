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
    $procurement = new Procurement($db);

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

        http_response_code(200);

        echo json_encode($procurement_arr);
    }
    else{
        //set response code - 404 not found
        http_response_code(404);

        //tell the suer no procurements fond
        echo json_encode(
            array("message" => "No products found.")
        );
    }
?>