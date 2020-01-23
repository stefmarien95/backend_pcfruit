<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/HandmatigeMeting.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$handmatigeMeting = new HandmatigeMeting($db);

// query products
$stmt = $handmatigeMeting->read();
$num = $stmt->rowCount();


if($num>0){


    $handmatigeMeting_arr=array();
    $handmatigeMeting_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $handmatigeMeting_item=array(
            "id" => $id,
            "meting" => $meting,
            "tijd" => $tijd,
            "soortmetingId" => $soortmetingId,
            "vinificatieId" => $vinificatieId,
            "telefoonnummer" => $gebruikerId,



        );

        array_push( $gebruiker_arr["records"],  $handmatigeMeting_item);
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


