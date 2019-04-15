<?php

include("config/Database.php");

$db = new Database();
$db->query("SELECT role, email FROM User WHERE role = 5");
$db->execute();

$rows = $db->rowCount();

if ($rows > 0) {
	http_response_code(200);

	echo json_encode(array("message" => "Users found."));
} else {
	http_response_code(400);

	echo json_encode(array("message" => "No users found"));
}