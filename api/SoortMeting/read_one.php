<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/SoortMeting.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$soortMeting = new soortMeting($db);

// set ID property of record to read
$soortMeting->id = isset($_GET['id']) ? $_GET['id'] : die();


$soortMeting->readOne();

if($soortMeting->id!=null){

    $soortMeting_arr = array(
        "id" =>  $soortMeting->id,
        "naam" => $soortMeting->naam



    );


    http_response_code(200);


    echo json_encode( $soortMeting_arr );
}

else{

    http_response_code(404);


    echo json_encode(array("message" => "Item does not exist."));
}
?>