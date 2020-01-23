<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/FysiekeSensor.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$fysiekeSensor = new FysiekeSensor($db);

// query products
$stmt = $fysiekeSensor->read();
$num = $stmt->rowCount();


if($num>0){


    $fysiekeSensor_arr=array();
    $fysiekeSensor_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $fysiekeSensor_item=array(
            "id" => $id,
            "soortSensorId" => $soortSensorId,




        );

        array_push( $fysiekeSensor_arr["records"],  $fysiekeSensor_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($fysiekeSensor_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}



