<?php

    require_once "../lib/webPush.php";
    header('Content-Type: application/json');

    try{
        $body = file_get_contents("php://input");

        $subscriber = json_decode($body["subscription"]);
        $message = $body["message"];

        $webpush = new _WebPush();
        $webpush->sendNotification($subscriber,$message);
        echo json_encode($webpush);
    }catch(error $e){
        echo "hay un error :C <br>";
        echo $e;
    }


