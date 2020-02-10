<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");
header("Accept: application/json;");

// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/Vat.php';

$database = new Database();
$db = $database->getConnection();

$vat = new Vat($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty


    $vat->nummer = $data->nummer;
    $vat->inGebruik = $data->inGebruik;
    $vat->gelinkt = $data->gelinkt;

    if($vat->create()){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "item was created."));
    }

else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create. Data is incomplete."));
}
?>