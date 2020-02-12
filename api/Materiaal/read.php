<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/Materiaal.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$materiaal = new Materiaal($db);

// query products
$stmt = $materiaal->read();
$num = $stmt->rowCount();


if($num>0){


    $materiaal_arr=array();
    $materiaal_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $materiaal_item=array(
            "id" => $id,
            "naam" => $naam,


        );

        array_push( $materiaal_arr["records"],  $materiaal_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($materiaal_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}



