<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/WijnType.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$wijnType = new WijnType($db);

// query products
$stmt = $wijnType->read();
$num = $stmt->rowCount();


if($num>0){


    $wijnType_arr=array();
    $wijnType_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $wijnType_item=array(
            "id" => $id,
            "naam" => $naam,


        );

        array_push( $wijnType_arr["records"],  $wijnType_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($wijnType_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}



