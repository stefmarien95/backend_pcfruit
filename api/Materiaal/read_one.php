<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/Materiaal.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$materiaal = new Materiaal($db);

// set ID property of record to read
$materiaal->id = isset($_GET['id']) ? $_GET['id'] : die();


$materiaal->readOne();

if($materiaal->id!=null){

    $materiaal_arr = array(
        "id" =>  $materiaal->id,
        "naam" => $materiaal->naam



    );


    http_response_code(200);


    echo json_encode( $materiaal_arr );
}

else{

    http_response_code(404);


    echo json_encode(array("message" => "Item does not exist."));
}
?>