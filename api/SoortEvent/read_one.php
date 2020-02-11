<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/SoortEvent.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$soortEvent = new soortEvent($db);

// set ID property of record to read
$soortEvent->id = isset($_GET['id']) ? $_GET['id'] : die();


$soortEvent->readOne();

if($soortEvent->id!=null){

    $soortEvent_arr = array(
        "id" =>  $soortEvent->id,
        "naam" => $soortEvent->naam



    );


    http_response_code(200);


    echo json_encode( $soortEvent_arr );
}

else{

    http_response_code(404);


    echo json_encode(array("message" => "Item does not exist."));
}
?>