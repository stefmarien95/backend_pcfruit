<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/Vinificatie.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$vinificatie = new Vinificatie($db);

// set ID property of record to read
$vinificatie->id = isset($_GET['id']) ? $_GET['id'] : die();


$vinificatie->readOne();

if($vinificatie->vatId!=null){

    $vinificatie_arr = array(
        "id" => $id,
        "vatId" => $vatId,
        "persmethodeId" => $persmethodeId,
        "persHoeveelheid" => $persHoeveelheid,
        "oogst" => $oogst,
        "persDruk" => $persDruk,
        "actief" => $actief,
        "wijnTypeId" => $wijnTypeId,
        "jaargang" => $jaargang


    );


    http_response_code(200);

    // make it json format
    echo json_encode($vinificatie_arr);
}

else{

    http_response_code(404);


    echo json_encode(array("message" => "Item does not exist."));
}
?>
