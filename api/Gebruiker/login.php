<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/Gebruiker.php';

$database = new Database();
$db = $database->getConnection();

$gebruiker = new Gebruiker($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$gebruiker->email = $data->email;
$email_exists = $gebruiker->emailExists();

// generate json web token
include_once '../config/core.php';
include_once '../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../libs/php-jwt-master/src/ExpiredException.php';
include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

// check if email exists and if password is correct
if($email_exists && password_verify($data->wachtwoord, $gebruiker->wachtwoord)){

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


        )
    );

    // set response code
    http_response_code(200);

    // generate jwt
    $jwt = JWT::encode($token, $key);
    echo json_encode(
        array(
            "message" => "Successful login.",
            "voornaam"=> $gebruiker->voornaam,
            "naam" => $gebruiker->naam,
            "rolId" => $gebruiker->rolId,
            "gebruikersnaam" => $gebruiker->gebruikersnaam,
            "wachtwoord" => $gebruiker->wachtwoord,
            "email" => $gebruiker->email,
            "telefoonnummer" => $gebruiker->telefoonnummer,
            "jwt" => $jwt,


        )
    );

}

