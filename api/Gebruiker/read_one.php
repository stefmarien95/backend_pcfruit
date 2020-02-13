<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/Gebruiker.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$gebruiker= new Gebruiker($db);

// set ID property of record to read
$gebruiker->id = isset($_GET['id']) ? $_GET['id'] : die();


$gebruiker->readOne();

if($gebruiker->id!=null){

    $gebruiker_arr = array(
        "id" =>  $gebruiker->id,
        "rollId" => $gebruiker->rollId,
        "voornaam" =>  $gebruiker->voornaam,
        "naam" => $gebruiker->naam,
        "gebruikersnaam" =>  $gebruiker->gebruikersnaam,
        "wachtwoord" => $gebruiker->wachtwoord,
        "email" => $gebruiker->email,
        "telefoonnummer" => $gebruiker->telefoonnummer


    );

    http_response_code(200);

    // make it json format
    echo json_encode($gebruiker_arr);
}

else{

    http_response_code(404);


    echo json_encode(array("message" => "Item does not exist."));
}
?>
