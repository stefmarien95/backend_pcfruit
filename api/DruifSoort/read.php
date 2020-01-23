<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/DruifSoort.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$druifSoort = new DruifSoort($db);

// query products
$stmt = $druifSoort->read();
$num = $stmt->rowCount();


if($num>0){


    $druifSoort_arr=array();
    $druifSoort_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $druifSoort_item=array(
            "id" => $id,
            "druifsoort " => $druifsoort




        );

        array_push( $druifSoort_arr["records"],  $druifSoort_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($druifSoort_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}



