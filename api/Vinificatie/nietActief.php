<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/Vinificatie.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$vinificatie = new Vinificatie($db);

// query products
$stmt = $vinificatie->nietActief();
$num = $stmt->rowCount();


if($num>0){


    $vinificatie_arr=array();
    $vinificatie_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $vinificatie_item=array(
            "id" => $id,
            "vatId" => $vatId,
            "persmethodeId" => $persmethodeId,
            "persHoeveelheid" => $persHoeveelheid,
            "oogst" => $oogst,
            "persDruk" => $persDruk,
            "actief" => $actief,
            "wijnTypeId" => $wijnTypeId,
            "jaargang" => $jaargang

        );

        array_push( $vinificatie_arr["records"],  $vinificatie_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($vinificatie_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}

