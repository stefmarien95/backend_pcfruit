<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/SoortMeting.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$soortMeting = new SoortMeting($db);

// query products
$stmt = $soortMeting->read();
$num = $stmt->rowCount();


if($num>0){


    $soortMeting_arr=array();
    $soortMeting_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $soortMeting_item=array(
            "id" => $id,
            "naam" => $naam,


        );

        array_push( $soortMeting_arr["records"],  $soortMeting_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($soortMeting_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}



