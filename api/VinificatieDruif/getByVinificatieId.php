<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/VinificatieDruifsoort.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$vinificatieDruif = new VinificatieDruifsoort($db);

// set ID property of record to read
$vinificatieDruif->vinificatieId = isset($_GET['vinificatieId']) ? $_GET['vinificatieId'] : die();


$stmt=$vinificatieDruif->readDruif();
$num = $stmt->rowCount();


if($num>0){

    $vinificatieDruif_arr=array();
    $vinificatieDruif_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $vinificatie_item=array(
            "druifsoortId" => $druifsoortId,
            "vinificatieId" => $vinificatieId,
            "druifsoort" =>$druifsoort

        );

        array_push( $vinificatieDruif_arr["records"],  $vinificatie_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($vinificatieDruif_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}


