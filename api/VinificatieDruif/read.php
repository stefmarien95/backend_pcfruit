<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/VinificatieDruif.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$vinificatieDruif = new VinificatieDruif($db);

// query products
$stmt = $vinificatieDruif->read();
$num = $stmt->rowCount();


if($num>0){


    $vinificatiedruif_arr=array();
    $vinificatiedruif_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $vinificatiedruif_item=array(
            "id" => $id,
            "druifsoortId" => $druifsoortId,
            "vinificatieId" => $vinificatieId,



        );

        array_push( $vinificatiedruif_arr["records"],  $vinificatiedruif_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($vinificatiedruif_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}


