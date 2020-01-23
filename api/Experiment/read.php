<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/Experiment.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$experiment = new Experiment($db);

// query products
$stmt = $experiment->read();
$num = $stmt->rowCount();


if($num>0){


    $experiment_arr=array();
    $experiment_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $experiment_item=array(
            "id" => $id,
            "naam" => $naam,
            "opdrachtgever" => $opdrachtgever,
            "opleverdatum" => $opleverdatum,



        );

        array_push( $experiment_arr["records"],  $experiment_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($experiment_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}



