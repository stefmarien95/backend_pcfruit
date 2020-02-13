<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/AlarmLog.php';

$database = new Database();
$db = $database->getConnection();

// initialize object
$alarmLog = new AlarmLog($db);

$alarmLog->vinificatieId = isset($_GET['vinificatieId']) ? $_GET['vinificatieId'] : die();

// query products
$stmt = $alarmLog->getByVinificatieId();
$num = $stmt->rowCount();


if($num>0){

    $alarmLog_arr=array();
    $alarmLog_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $alramLog_item=array(

            "id" =>$id,
            "vinificatieId" =>$vinificatieId,
            "bericht" => $bericht,
            "datum"=>$datum


        );

        array_push( $alarmLog_arr["records"],  $alramLog_item);
    }

    // set response code - 200 OK
    http_response_code(200);


    echo json_encode($alarmLog_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);


    echo json_encode(
        array("message" => "Nothing found.")
    );
}
?>