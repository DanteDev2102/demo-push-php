<?php

    require "../lib/webPush.php";

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Content-Type: application/json');

    try{
        $body = file_get_contents("php://input");

        $subscriber = json_decode($body["subscription"]);
        $message = $body["message"];

        $webpush = new _WebPush();
        $webpush->sendNotification($subscriber,$message);
        http_response_code(201);
        echo json_encode($webpush);
    }catch(error $e){
        http_response_code(500);
        echo $e;
    }


