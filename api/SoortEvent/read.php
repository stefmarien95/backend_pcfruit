<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/SoortEvent.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$soortEvent= new SoortEvent($db);

// query products
$stmt = $soortEvent->read();
$num = $stmt->rowCount();


if($num>0){


    $soortEvent_arr=array();
    $soortEvent_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $soortEvent_item=array(
            "id" => $id,
            "naam" => $naam,


        );

        array_push( $soortEvent_arr["records"],  $soortEvent_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($soortEvent_arr);
}


else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}


