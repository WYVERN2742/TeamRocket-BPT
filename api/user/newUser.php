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
// using post instead because it's easier


// Ensure roles are of a set type
$role = "REQUESTER";
switch ($_POST['role']) {
	case "CENTRAL_FINANCE":
		$role = "CENTRAL_FINANCE";
		break;
	case "REQUISITION_OFFICER":
		// Yes, 'REQUSITION' is misspelt
		// Blame the db team...
		$role = "REQUSITION_OFFICER";
		break;
}

if (isset($_SESSION['user'])) {
	try {
		$rs = $Admin->addUser(password_hash($_POST['password'],PASSWORD_BCRYPT), $_POST['firstName'], $_POST['lastName'], $role, $_POST['roomNumber'], $_POST['telephone'], $_POST['email']);

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
