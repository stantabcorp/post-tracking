<?php 

    namespace Services;

    class LaPoste extends \Services\Services{

        public $serviceName = "laposte";
        public $serviceCountry = "FR";
        public $serviceCode = "EP";

        public function track($code){
            $client = new \GuzzleHttp\Client();
            $result = $client->get("https://api.laposte.fr/suivi/v2/idships/{$code}?lang=en_GB", [
                "headers" => [
                    "X-Okapi-Key" => getenv("LAPOSTE_KEY"),
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
                "product" => $json['shipment']['product'],
                "events" => [],
            ];

            foreach($json['shipment']['event'] as $event){
                $response['events'][] = [
                    "date" => date('Y-m-d H:i:s', strtotime($event['date'])),
                    "description" => $event['label']
                ];
            }

            return $response;
        }

    }