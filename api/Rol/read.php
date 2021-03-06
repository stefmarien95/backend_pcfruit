<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/Rol.php';


$database = new Database();
$db = $database->getConnection();

// initialize object
$rol = new Rol($db);

// query products
$stmt = $rol->read();
$num = $stmt->rowCount();


if($num>0){


    $rol_arr=array();
    $rol_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $rol_item=array(
            "id" => $id,
            "rolnaam" => $rolnaam,


        );

        array_push( $rol_arr["records"],  $rol_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($rol_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}



