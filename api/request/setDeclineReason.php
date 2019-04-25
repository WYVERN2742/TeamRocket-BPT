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

if (isset($_SESSION['user'])) {
	try {
        $rs = $procurement->setDeclineReason($data->procurementId, $data->declineReason);
        // $rs = $procurement->setDeclineReason(328, "test"); exmaple that works
        http_response_code(200);
        echo json_encode($rs);

	} catch (PDOException $e) { }
} else {
	// set response code
	http_response_code(401);

	// show error message
	echo json_encode(array(
		"message" => "Access denied."
	));
}
