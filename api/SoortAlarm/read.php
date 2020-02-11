<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/SoortSensor.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$soortSensor = new SoortSensor($db);

// query products
$stmt = $soortSensor->read();
$num = $stmt->rowCount();


if($num>0){


    $soortSensor_arr=array();
    $soortSensor_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $soortSensor_item=array(
            "id" => $id,
            "naam" => $naam,


        );

        array_push( $soortSensor_arr["records"],  $soortSensor_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($soortSensor_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}


