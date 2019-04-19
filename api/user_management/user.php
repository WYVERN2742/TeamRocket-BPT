<?php
//header("Access-Control-Allow-Origin: http://localhost/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../objects/CentralFinance.php';

session_start();

$db = new Database();
$central = new CentralFinance($db);

//$data = json_decode(file_get_contents("php://input"));
//just using post instead because it's easier

if (isset($_SESSION['user'])) {
	$rs = $central->viewUser($data->userId);

	http_response_code(200);

	echo json_encode($rs);
} else {
	// set response code
	http_response_code(401);

	// show error message
	echo json_encode(array(
		"message" => "Access denied.",
	));
}
