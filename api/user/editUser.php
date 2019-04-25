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
error_log($data);

// Ensure roles are of a set type
$role = "REQUESTER";
switch ($data->role) {
	case "CENTRAL_FINANCE":
		$role = "CENTRAL_FINANCE";
		break;
	case "REQUISITION_OFFICER":
		$role = "REQUISITION_OFFICER";
		break;
}

if (isset($_SESSION['user'])) {
	try {

		$rs = $Admin->editUser($data->userId, $data->firstName, $data->lastName, $role, $data->roomNumber, $data->telephone, $data->email);

		if ($data->password != "") {
			$prs = $Admin->changePassword($data->userId, password_hash($data->password, PASSWORD_BCRYPT));
		}


		if ($rs) {
			http_response_code(200);
		} else {

			echo json_encode($Admin->getError());
			http_response_code(400);
		}

		echo json_encode($rs);
	} catch (PDOException $e) {
		http_response_code(400);
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
