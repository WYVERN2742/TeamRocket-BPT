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

        $newStatus = -1;

        if ($data->status == "DECLINED") {
            $newStatus = "DECLINED";
        } else {
            switch ($data->status) {
                case "DRAFT":
                    $newStatus = 2;
                    break;
                case "BEFORE_BUDGET_APPROVAL":
                    $newStatus = 3;
                    break;
                case "BEFORE_FINANCE_APPROVAL":
                    $newStatus = 4;
                    break;
                case "BEFORE_REQ_APPROVAL":
                    $newStatus = 5;
                    break;
            }
        }

        if ($newStatus != -1) {
            $rs = $procurement->changeState($data->procurementId, $newStatus);
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
