<?php
//header("Access-Control-Allow-Origin: http://localhost/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

session_start();

include_once 'config/Database.php';
include_once 'objects/User.php';

$db = new Database();
if ($db->getCreationError() != null) {
	echo json_encode(
		array(
			"message" => $db->getCreationError(),
		)
	);
	http_response_code(500);
	die();
}

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->email = $data->email;
$email_exists = $user->emailExists();

if ($email_exists && password_verify($data->password, $user->password)) {
	$_SESSION['user'] = $user->userId;
	$_SESSION['userRole'] = $user->role;
	echo json_encode(
		array(
			"message" => "Successful login.",
		)
	);

	http_response_code(200);
} else {
	http_response_code(401);
}
