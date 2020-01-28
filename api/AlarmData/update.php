<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../objects/AlarmData.php';


$database = new Database();
$db = $database->getConnection();


$alarmData = new AlarmData($db);


$data = json_decode(file_get_contents("php://input"));


$alarmData->id = $data->id;


$alarmData->soortAlarmId = $data->soortAlarmId;
$alarmData->vinificatieId = $data->vinificatieId;
$alarmData->minimumwaarde = $data->minimumwaarde;
$alarmData->maximumwaarde = $data->maximumwaarde;



if($alarmData->update()){


    http_response_code(200);

    echo json_encode(array("message" => "Item was updated."));
}

else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to update."));
}
?>
