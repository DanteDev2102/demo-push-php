<?php

    use Minishlink\WebPush\WebPush;
    use Minishlink\WebPush\Subscription;
    require '../../vendor/autoload.php';

    class _WebPush {     
        
        public function __construct()
        {
            $this->subject = "mailto:jdap.dmc@gmail.com";
            $this->publicVapidKey = "BEI6UpI3Pcdrjotz0Y4gxaGJEy6hZkJF4iA6-iC1mmEbHBUzHduP7uzsM0FvHN2PR8LjnTBaSW9RxvXQ1BqQKxQ";
            $this->privateVapidKey = "Myg05860F1fjHEkNwG5dkpVcMZ8YFJWWikPw3KGSfb8";
            $this->webPush = new WebPush([
                "VAPID" => [
                    "subject" => $this->subject,
                    "publicKey" => $this->publicVapidKey,
                    "privateKey" => $this->privateVapidKey
                ]
            ]);
        }

        public function sendNotification(array $subscriber , string $message)
        {
            $notification = [
                "subscription" => Subscription::create($subscriber),
                "payload" => [
                    "message" => $message,
                    "title" => "Notify"
                ]
             ];

             $webPush = $this->webPush;

            return $webPush->sendOneNotification($notification["subscription"],json_encode($notification["payload"]));
        }
    }

?>