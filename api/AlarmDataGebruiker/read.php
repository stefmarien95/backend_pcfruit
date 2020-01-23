<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/AlarmDataGebruiker.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$alarmDataGebruiker = new AlarmDataGebruiker($db);

// query products
$stmt = $alarmDataGebruiker->read();
$num = $stmt->rowCount();


if($num>0){

    $alarmDataGebruiker_arr=array();
    $alarmDataGebruiker_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $alarmDataGebruiker_item=array(
            "id" => $id,
            "naam" => $naam,
            "gebrukerId" =>$gebruikerId,
            "alarmDataId" => $alarmDataId,


        );

        array_push( $alarmDataGebruiker_arr["records"],  $alarmDataGebruiker_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($alarmDataGebruiker_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}



