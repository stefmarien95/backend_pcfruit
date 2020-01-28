<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/AlarmDataGebruiker.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$alarmDatagebruiker = new AlarmDataGebruiker($db);

// set ID property of record to read
$alarmDatagebruiker->id = isset($_GET['id']) ? $_GET['id'] : die();


$alarmDatagebruiker->readOne();

if($alarmDatagebruiker->gebruikerId!=null){

    $alarmDatagebruiker_arr = array(
        "gebruikerId" =>  $alarmDatagebruiker->gebruikerId,
        "alarmdataId" => $alarmDatagebruiker->alarmdataId



    );


    http_response_code(200);


    echo json_encode( $alarmDatagebruiker_arr );
}

else{

    http_response_code(404);


    echo json_encode(array("message" => "Item does not exist."));
}
?>