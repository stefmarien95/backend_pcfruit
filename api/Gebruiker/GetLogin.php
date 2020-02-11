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
// generate json web token
include_once '../config/core.php';
include_once '../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../libs/php-jwt-master/src/ExpiredException.php';
include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$gebruiker = new Gebruiker($db);

// set ID property of record to read

$gebruiker->email = isset($_GET['email']) ? $_GET['email'] : die();
$gebruiker->wachtwoord = isset($_GET['wachtwoord']) ? $_GET['wachtwoord'] : die();


$gebruiker->readOne();

$token = array(
    "iss" => $iss,
    "aud" => $aud,
    "iat" => $iat,
    "nbf" => $nbf,
    "data" => array(
        "id" => $gebruiker->id,
        "voornaam" => $gebruiker->voornaam,
        "naam" => $gebruiker->naam,
        "rolId" => $gebruiker->rolId,
        "gebruikersnaam" => $gebruiker->gebruikersnaam,
        "wachtwoord" => $gebruiker->wachtwoord,
        "email" => $gebruiker->email,
        "telefoonnummer" => $gebruiker->telefoonnummer


    ));

$jwt = JWT::encode($token, $key);

if($gebruiker->email!=null){

    $gebruiker_arr = array(
        "id" =>  $gebruiker->id,
        "rolId" => $gebruiker->rolId,
        "voornaam" => $gebruiker->voornaam,
        "naam" => $gebruiker->naam,
        "gebruikersnaam" => $gebruiker->gebruikersnaam,
        "wachtwoord" => $gebruiker->wachtwoord,
        "email" => $gebruiker->email,
        "telefoonnummer" => $gebruiker->telefoonnummer,
        "jwt" => $jwt



    );


    http_response_code(200);

    echo json_encode($gebruiker_arr);
}

else{

    http_response_code(404);


    echo json_encode(array("message" => "Item does not exist."));
}
?>