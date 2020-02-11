<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/soortAlarm.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$soortAlarm = new soortAlarm($db);


$soortAlarm->id = isset($_GET['id']) ? $_GET['id'] : die();


$soortAlarm->readOne();

if($soortAlarm->id!=null){

    $soortAlarm_arr = array(
        "id" =>  $soortAlarm->id,
        "naam" => $soortAlarm->naam



    );


    http_response_code(200);


    echo json_encode($soortAlarm_arr);
}

else{

    http_response_code(404);


    echo json_encode(array("message" => "Item does not exist."));
}
?>