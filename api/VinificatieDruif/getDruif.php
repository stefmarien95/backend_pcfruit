<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/VinificatieDruifsoort.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$VinificatieDruifsoort = new VinificatieDruifsoort($db);

// query products
$stmt = $VinificatieDruifsoort->readDruif();
$num = $stmt->rowCount();


if($num>0){


    $vinificatiedruifsoort_arr=array();
    $vinificatiedruifsoort_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $vinificatiedruifsoort_item=array(
            "druifsoortId" => $druifsoortId,
            "vinificatieId" => $vinificatieId,
            "druifsoort" => $druifsoort





        );

        array_push( $vinificatiedruifsoort_arr["records"],  $vinificatiedruifsoort_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($vinificatiedruifsoort_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}

