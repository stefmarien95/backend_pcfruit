<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/AlarmData.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$alarmData = new AlarmData($db);

// set ID property of record to read

$alarmData->vinificatieId = isset($_GET['vinificatieId']) ? $_GET['vinificatieId'] : die();
$alarmData->soortAlarmId = isset($_GET['soortAlarmId']) ? $_GET['soortAlarmId'] : die();


$alarmData->getByVinificatie();

if($alarmData->minimumwaarde!=null){

    $alarmData_arr = array(
        "id" =>  $alarmData->id,
        "soortAlarmId" => $alarmData->soortAlarmId,
        "vinificatieId" => $alarmData->vinificatieId,
        "minimumwaarde" => $alarmData->minimumwaarde,
        "maximumwaarde" => $alarmData->maximumwaarde


    );


    http_response_code(200);

    echo json_encode($alarmData_arr);
}

else{

    http_response_code(404);


    echo json_encode(array("message" => "Item does not exist."));
}
?>