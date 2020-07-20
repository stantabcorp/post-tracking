<?php 

    namespace Services;

    use PHPHtmlParser\Dom;

    class LatvijasPasts extends \Services\Services{

        public $serviceName = "latvijaspasts";
        public $serviceCountry = "LY";
        public $serviceCode = "LV";

        // I wasn't able to find a public (or private) api... Only option: scrapping...
        public function track($code){
            $dom = new Dom;
            $dom->loadFromUrl("https://track.pasts.lv/consignment/tracking?type=pasts&id={$code}&language-picker-language=en-US");

            if(count($dom->find(".message.error")) > 0){
                return false;
            }            

            $response = [
                "service" => $this->serviceName,
                "tracking" => $code,
                "product" => null,
                "events" => [],
            ];

            foreach($dom->find(".delivery") as $event){
                $time = $event->find(".time")[0];
                $date = $time->find("p")[0]->text . " " . $time->find('h4')[0]->text;
                $place = $event->find('.place')[0]->find('p')[0]->text;
                $status = $event->find('.status')[0]->find('h4')[0]->text;
                $response['events'][] = [
                    "date" => date('Y-m-d H:i:s', strtotime($date)),
                    "description" => "{$status} - {$place}"
                ];
            }

            return $response;
        }

    }