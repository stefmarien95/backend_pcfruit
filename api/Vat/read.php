<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/Vat.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$vat = new Vat($db);

// query products
$stmt = $vat->read();
$num = $stmt->rowCount();


if($num>0){


    $vat_arr=array();
    $vat_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $vat_item=array(
            "id" => $id,
            "nummer" => $nummer,
            "inGebruik" => $inGebruik,
            "gelinkt" => $gelinkt,
            "materiaalId" => $materiaalId,
            "volume" => $volume,
            "mangat" => $mangat,
            "deksel" => $deksel,
            "koelmantel" => $koelmantel



        );

        array_push( $vat_arr["records"],  $vat_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($vat_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}


