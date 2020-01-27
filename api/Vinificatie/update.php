<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../objects/Vinificatie.php';


$database = new Database();
$db = $database->getConnection();


$vinificatie = new Vinificatie($db);


$data = json_decode(file_get_contents("php://input"));


$vinificatie->id = $data->id;

// set product property values
$vinificatie->vatId = $data->vatId;
$vinificatie->persmethodeId = $data->persmethodeId;
$vinificatie->persHoeveelheid = $data->persHoeveelheid;
$vinificatie->oogst = $data->oogst;
$vinificatie->persDruk = $data->persDruk;
$vinificatie->actief = $data->actief;

if($vinificatie->update()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Item was updated."));
}

// if unable to update the product, tell the user
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to update."));
}
?>