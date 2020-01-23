<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/AlarmData.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$alarmData = new AlarmData($db);

// query products
$stmt = $alarmData->read();
$num = $stmt->rowCount();


if($num>0){

    $alarmData_arr=array();
    $alarmData_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $alarmData_item=array(
            "id" => $id,
            "naam" => $naam,
            "minimumwaarde" =>$minimumwaarde,
            "price" => $maximumwaarde,
            "fysiekeSensorId" => $fysiekeSensorId,

        );

        array_push( $alarmData_arr["records"],  $alarmData_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($alarmData_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}



