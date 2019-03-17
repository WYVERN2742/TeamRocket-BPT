<?php
header("Access-Control-Allow-Origin: http://localhost/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/core.php';
include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

include_once 'config/database.php';
include_once 'objects/user.php';

$db = new Database();
$user = new User($db);

$jwt = json_decode(file_get_contents("php://input"));

// if jwt is not empty
if($jwt){

    // if decode succeed, show user details
    try {

        // decode jwt
        $decoded = JWT::decode($jwt, $key, array('HS256'));

        $user->userId = $decoded->data->userId;

        $db->query("SELECT * FROM Procurement WHERE requesterId = :requesterId");
        $db->bind(":requesterId", $user->userId);
        $db->execute();
        $rs = $db->resultSet();

        http_response_code(200);

        echo json_encode($rs);
    } catch (Exception $e) {

        // set response code
        http_response_code(401);

        // show error message
        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }
}

// error message if jwt is empty will be here