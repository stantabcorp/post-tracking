<?php 

    namespace Services;

    class RoyalMail extends \Services\Services{

        public $serviceName = "royalmail";
        public $serviceCountry = "GB";
        public $serviceCode = "FQ";

        public function track($code){
            $client = new \GuzzleHttp\Client();
            $result = $client->get("https://api.royalmail.net/mailpieces/v2/{$code}/events", [
                "headers" => [
                    "X-Accept-Rmg-Terms" => "yes",
                    "X-IBM-Client-Secret" => getenv("ROYALMAIL_SECRET"),
                    "X-IBM-Client-Id" => getenv("ROYALMAIL_PUBLIC"),
                    "Accept" => "application/json"
                ],
                "http_errors" => false,
            ]);

            if($result->getStatusCode() != 200){
                return false;
            }

            $json = json_decode($result->getBody(), true);

            $response = [
                "service" => $this->serviceName,
                "tracking" => $code,
                "product" => $json['summary']['productName'],
                "events" => [],
            ];

            foreach($json['events'] as $event){
                $response['events'][] = [
                    "date" => date('Y-m-d H:i:s', strtotime($event['eventDateTime'])),
                    "description" => $event['eventCode'] . " - " . $event['eventName'] . " - " . $event['locationName']
                ];
            }

            return $response;
        }

    }