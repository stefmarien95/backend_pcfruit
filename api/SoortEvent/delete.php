<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/database.php';
include_once '../objects/SoortEvent.php';


$database = new Database();
$db = $database->getConnection();

$soortEvent = new SoortEvent($db);


$data = json_decode(file_get_contents("php://input"));


$soortEvent->id = $data->id;



if($soortEvent->delete()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "item was deleted."));
}

// if unable to delete the product
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to delete item."));
}
?>