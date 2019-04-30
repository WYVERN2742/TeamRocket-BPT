<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../objects/Admin.php';

session_start();

$db = new Database();
$admin = new Admin($db);

$json = file_get_contents('php://input'); //takes raw data from the request

$data = json_decode($json); //decodes the json data passed to the obj

if (isset($_SESSION['user'])) {
    try {

        $canApprove = false;

        switch ($data->status) {
            case "BEFORE_BUDGET_APPROVAL":
                if ($admin->viewBudgetCode($data->budgetCode)["ownerId"] == $_SESSION['user']) {
                    $canApprove = true;
                }
                break;
            case "BEFORE_FINANCE_APPROVAL":
                if ($_SESSION["userRole"] == "CENTRAL_FINANCE") {
                    $canApprove = true;
                }
                break;
            case "BEFORE_REQ_APPROVAL":
                if ($admin->viewBudgetCode($data->budgetCode)["procurementOfficer"] == $_SESSION['user']) {
                    $canApprove = true;
                }
                break;
        }

        if ($canApprove) {

            echo json_encode(array(
                "message" => "Can approve."
            ));
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode(array(
                "message" => "Cannot approve."
            ));
        }
    } catch (PDOException $e) {

        http_response_code(500);
    }
} else {
    // set response code
    http_response_code(401);

    // show error message
    echo json_encode(array(
        "message" => "Access denied."
    ));
}
