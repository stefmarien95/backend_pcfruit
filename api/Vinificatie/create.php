<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/Vinificatie.php';

$database = new Database();
$db = $database->getConnection();

$vinificatie = new Vinificatie($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->vatId) &&
    !empty($data->persmethodeId) &&
    !empty($data->persHoeveelheid) &&
    !empty($data->oogst) &&
    !empty($data->persDruk) &&
    !empty($data->actief)


){

    $vinificatie->vatId = $data->vatId;
    $vinificatie->persmethodeId = $data->persmethodeId;
    $vinificatie->persHoeveelheid = $data->persHoeveelheid;
    $vinificatie->oogst = $data->oogst;
    $vinificatie->persDruk= $data->persDruk;
    $vinificatie->actief = $data->actief;



    if($vinificatie->create()){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "item was created."));
    }

    // if unable to create the , tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create."));
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create. Data is incomplete."));
}
?>