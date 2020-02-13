<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/VinificatieGebruiker.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$vinificatieGebruiker = new VinificatieGebruiker($db);


$stmt = $vinificatieGebruiker->read();
$num = $stmt->rowCount();


if($num>0){


    $vinificatieGebruiker_arr=array();
    $vinificatieGebruiker_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $vinificatieGebruiker_item=array(

            "gebruikerId" => $gebruikerId,
            "vinificatieId" => $vinificatieId,
           


        );

        array_push( $vinificatieGebruiker_arr["records"],  $vinificatieGebruiker_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($vinificatieGebruiker_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}


