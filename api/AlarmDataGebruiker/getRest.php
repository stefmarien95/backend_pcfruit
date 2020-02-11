<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/AlarmDataGebruiker.php';

$database = new Database();
$db = $database->getConnection();

// initialize object
$alarmDataGebruiker = new AlarmDataGebruiker($db);

$alarmDataGebruiker->gebruikerId = isset($_GET['gebruikerId']) ? $_GET['gebruikerId'] : die();

// query products
$stmt = $alarmDataGebruiker->getByAlarmData();
$num = $stmt->rowCount();


if($num>0){

    $alarmDataGebruiker_arr=array();
    $alarmDataGebruiker_arr["records"]=array();




    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $alarmDataGebruiker_item=array(

            "gebruikerId" =>$gebruikerId,
            "alarmdataId" => $alarmdataId,
            "alarmData_vinificatieId" =>$alarmData_vinificatieId,
            "alarmData_minimumwaarde" => $alarmData_minimumwaarde,
            "alarmData_maximumwaarde" =>$alarmData_maximumwaarde,
            "alarmData_actief" => $alarmData_actief,
            "alarmData_vinificatie_vatId" =>$alarmData_vinificatie_vatId,
            "alarmData_vinificatie_persmethodeId" => $alarmData_vinificatie_persmethodeId,
            "alarmData_vinificatie_persHoeveelheid" =>$alarmData_vinificatie_persHoeveelheid,
            "alarmData_vinificatie_oogst" =>  $alarmData_vinificatie_oogst,
            "alarmData_vinificatie_persDruk" => $alarmData_vinificatie_persDruk,
            "alarmData_vinificatie_actief" => $alarmData_vinificatie_actief,




        );


        array_push( $alarmDataGebruiker_arr["records"],  $alarmDataGebruiker_item);


    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($alarmDataGebruiker_arr);

}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}
?>