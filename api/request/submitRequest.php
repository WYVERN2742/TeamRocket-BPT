<?php
//header("Access-Control-Allow-Origin: http://localhost/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../objects/Procurement.php';

session_start();

$db = new Database();
$procurement = new Procurement($db);

$json = '{
	"requesterId": "3",
	"budgetCode": "xn391037",
	"supplier": "1",
	"draft": "false", 
	"recurring": "false",
	"items":[
		{"itemNumber":"1","name":"butter","price":"2.50", "quantity": "2"},
		{"itemNumber":"2","name":"bread","price":"3.50", "quantity": "1"}		
	]
}'; 

$json = file_get_contents('php://input'); //takes raw data from the request

$data = json_decode($json); //decodes the json data passed to the obj

if (isset($_SESSION['user'])) {
	try { 
		$data->draft == "false" ? $status = "BEFORE_BUDGET_APPROVAL" : $status = "DRAFT";
		$data->recurring == "true" ? $recurring = true : $recurring = false;
		
		$rs = $procurement->insert($data->budgetCode, $data->requesterId, $status, $recurring, $data->supplier);
		
		if($rs){
			$procurementId = $procurement->insertedProcurementId()["procurementId"];

			foreach($data->items as $item){
				$procurement->insertItem($item->itemNumber, $procurementId, $item->name, $item->price, $item->quantity);
			}
		}
		else{
			http_response_code(500);
			echo json_encode($rs);
		}
	} 
	catch (PDOException $e) { 

	}
} else {
	// set response code
	http_response_code(401);

	// show error message
	echo json_encode(array(
		"message" => "Access denied."
	));
}
