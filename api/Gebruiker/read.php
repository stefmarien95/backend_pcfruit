<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/Gebruiker.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$gebruiker = new Gebruiker($db);

// query products
$stmt = $gebruiker->read();
$num = $stmt->rowCount();


if($num>0){


    $gebruiker_arr=array();
    $gebruiker_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $gebruiker_item=array(
            "id" => $id,
            "rolId" => $rolId,
            "voornaam" => $voornaam,
            "naam" => $naam,
            "gebruikersnaam" => $gebruikersnaam,
            "wachtwoord" => $wachtwoord,
            "email" => $email,
            "telefoonnummer" => $telefoonnummer,




        );

        array_push( $gebruiker_arr["records"],  $gebruiker_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($gebruiker_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}



