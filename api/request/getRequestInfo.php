<?php
//header("Access-Control-Allow-Origin: http://localhost/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../objects/Procurement.php';

session_start();

$json = file_get_contents('php://input');

$data = json_decode($json);

$db = new Database();
$procurement = new Procurement($db);

if (isset($_SESSION['user'])) {

	$procurementData = $procurement->getRequestInfo($data->procurementId);
	$itemsData = $procurement->getRequestItems($data->procurementId);
	$supplierData = $procurement->getSupplierInfo($data->procurementId);

	$procurementInfo["procurementInfo"] = $procurementData;
	$procurementInfo["items"] = $itemsData;
	$procurementInfo["supplier"] = $supplierData;

	http_response_code(200);

	echo json_encode($procurementInfo);
} else {
	// set response code
	http_response_code(401);

	// show error message
	echo json_encode(array(
		"message" => "Access denied."
	));
}
