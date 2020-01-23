<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/Event.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$event = new Event($db);

// query products
$stmt = $event->read();
$num = $stmt->rowCount();


if($num>0){


    $event_arr=array();
    $event_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $event_item=array(
            "id" => $id,
            "soortEventId" => $soortEventId,
            "vinificatieId" => $vinificatieId,
            "gebruikerId" => $gebruikerId,



        );

        array_push( $event_arr["records"],  $event_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($event_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}



