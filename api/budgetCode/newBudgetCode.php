<?php
//header("Access-Control-Allow-Origin: http://localhost/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../objects/Admin.php';

session_start();

$db = new Database();
$Admin = new Admin($db);

$data = json_decode(file_get_contents("php://input"));
error_log(file_get_contents("php://input"));

if (isset($_SESSION['user'])) {
	try {
		$rs = $Admin->createBudgetCode($data->budgetCode, $data->ownerId, $data->procurementOfficer);

		// Respond with 200 if $rs is true
		if ($rs) {
			http_response_code(200);
		} else {

			echo json_encode($Admin->getError());
			http_response_code(500);
		}

		echo json_encode($rs);
	} catch (PDOException $e) {
		http_response_code(500);
		echo json_encode(array(
			"message" => "Failed to update database",
			"error message" => $e->getMessage()
		));
	}
} else {
	// set response code
	http_response_code(401);

	// show error message
	echo json_encode(array(
		"message" => "Access denied."
	));
}
