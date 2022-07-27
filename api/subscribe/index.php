<?php

    require "../lib/webPush.php";

    if(isset($_SERVER["HTTP_ORIGIN"]))
    {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    }
    else
    {
        header("Access-Control-Allow-Origin: *");
    }

    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Max-Age: 600");

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_METHOD"]))
            header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT"); 

        if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"]))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
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


