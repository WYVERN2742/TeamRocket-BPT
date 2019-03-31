<?php
//header("Access-Control-Allow-Origin: http://localhost/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/Database.php';
include_once 'objects/User.php';

session_start();

$db = new Database();
$user = new User($db);

if (isset($_SESSION['user'])) {
    $db->query("SELECT * FROM Procurement WHERE requesterId = :requesterId");
    $db->bind(":requesterId", $_SESSION['user']);
    $db->execute();
    $rs = $db->resultSet();

    http_response_code(200);

    echo json_encode($rs);
} else {
    // set response code
    http_response_code(401);

    // show error message
    echo json_encode(array(
        "message" => "Access denied."
    ));
}