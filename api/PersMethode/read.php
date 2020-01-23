<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/PersMethode.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$persMethode = new PersMethode($db);

// query products
$stmt = $persMethode->read();
$num = $stmt->rowCount();


if($num>0){


    $persMethode_arr=array();
    $persMethode_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $persMethode_item=array(
            "id" => $id,
            "methode" => $methode,


        );

        array_push( $persMethode_arr["records"],  $persMethode_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($persMethode_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}



