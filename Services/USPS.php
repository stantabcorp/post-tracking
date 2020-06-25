<?php 

    namespace Services;

    class USPS extends \Services\Services{

        public $serviceName = "usps";
        public $serviceCountry = "US";
        public $serviceCode = "EJ";

        public function track($code){
            return false;
            // $response = [
            //     "service" => $this->serviceName,
            //     "tracking" => $code,
            //     "product" => $json['shipment']['product'],
            //     "events" => [],
            // ];

            // foreach($json['shipment']['event'] as $event){
            //     $response['events'][] = [
            //         "date" => date('Y-m-d H:i:s', strtotime($event['date'])),
            //         "description" => $event['label']
            //     ];
            // }

            // return $response;
        }

    }