<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/AutomatischeData.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$automatischeData = new AutomatischeData($db);

// query products
$stmt = $automatischeData->read();
$num = $stmt->rowCount();


if($num>0){

    $automatischeData_arr=array();
    $automatischeData_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $automatischeData_item=array(
            "id" => $id,
            "vinificatieId" => $vinificatieId,
            "fysiekeSensorId" => $fysiekeSensorId,
            "waarde" =>$waarde,



        );

        array_push( $automatischeData_arr["records"],  $automatischeData_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($automatischeData_arr);
}


else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}



