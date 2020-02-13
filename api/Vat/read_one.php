<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/Vat.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$vat = new Vat($db);

// set ID property of record to read
$vat->id = isset($_GET['id']) ? $_GET['id'] : die();


$vat->readOne();

if($vat->nummer!=null){

    $vat_arr = array(
        "id" => $vat->id,
        "nummer" => $vat->nummer,
        "inGebruik" => $vat->inGebruik,
        "gelinkt" => $vat->gelinkt,
        "materiaalId" => $vat->materiaalId,
        "volume" => $vat->volume,
        "mangat" => $vat->mangat,
        "deksel" => $vat->deksel,
        "koelmantel" => $vat->koelmantel,
        "locatie" => $locatie

    );


    http_response_code(200);

    // make it json format
    echo json_encode($vat_arr);
}

else{

    http_response_code(404);


    echo json_encode(array("message" => "Item does not exist."));
}
?>