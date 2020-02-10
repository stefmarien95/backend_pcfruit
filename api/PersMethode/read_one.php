<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/PersMethode.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$persMethode = new PersMethode($db);

// set ID property of record to read
$persMethode->id = isset($_GET['id']) ? $_GET['id'] : die();


$persMethode->readOne();

if($persMethode->id!=null){

    $persMethode_arr = array(
        "id" =>  $persMethode->id,
        "methode" => $persMethode->methode



    );


    http_response_code(200);


    echo json_encode( $persMethode_arr );
}

else{

    http_response_code(404);


    echo json_encode(array("message" => "Item does not exist."));
}
?>