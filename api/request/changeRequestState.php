<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../objects/Procurement.php';

session_start();

if (isset($_SESSION['user'])) {
	/**
	 * 
	 */

	$db = new Database();
	$procurement = new Procurement($db);

	$json = file_get_contents('php://input');

	$data = json_decode($json);

	try {
		switch ($data->state) { // Makes sure the state being set is one that will be accepted by the database
			case "DRAFT":
				$state = "DRAFT";
				break;
			case "BEFORE_BUDGET_APPROVAL":
				$state = "BEFORE_BUDGET_APPROVAL";
				break;
			case "BEFORE_FINANCE_APPROVAL":
				$state = "BEFORE_FINANCE_APPROVAL";
				break;
			case "BEFORE_REQ_APPROVAL":
				$state = "BEFORE_REQ_APPROVAL";
				break;
			case "DONE":
				$state = "DONE";
				break;
			case "DECLINED":
				$state = "DECLINED";
				break;
			default:
				$state = "INVALID";
		}

		if ($state != "INVALID") {
			$rs = $procurement->changeState($data->procurementId, $state);
			http_response_code(200);
			echo json_encode($rs);
		} else {
			http_response_code(500);
			echo json_encode(array("message" => "Invalid role"));
		}
	} catch (PDOException $e) { }
} else {
	// set response code
	http_response_code(401);

	// show error message
	echo json_encode(array(
		"message" => "Access denied."
	));
}
