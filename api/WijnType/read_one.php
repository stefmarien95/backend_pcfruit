<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/WijnType.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$wijnType = new WijnType($db);

// set ID property of record to read
$wijnType->id = isset($_GET['id']) ? $_GET['id'] : die();


$wijnType->readOne();

if($wijnType->id!=null){

    $wijnType_arr = array(
        "id" =>  $wijnType->id,
        "naam" => $wijnType->naam



    );


    http_response_code(200);


    echo json_encode( $wijnType_arr );
}

else{

    http_response_code(404);


    echo json_encode(array("message" => "Item does not exist."));
}
?>