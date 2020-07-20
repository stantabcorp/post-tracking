<?php

    namespace Tests;

    class LatvijasPastsTest extends Wrapper{

        public function testSuccessTracking(){
            $this->beforeTest();
            $response = $this->generate(
                $this->getRequest("GET", "/service/latvijaspasts/track", "code=LY004742269LV")
            );
            $json = $this->parseJsonResponse($response);
            $this->assertEquals(200, $response->getStatusCode());
            $this->assertEquals(true, $json['success']);
        }

        public function testErrorTracking(){
            $this->beforeTest();
            $response = $this->generate(
                $this->getRequest("GET", "/service/latvijaspasts/track", "code=ABCD")
            );
            $json = $this->parseJsonResponse($response);
            $this->assertEquals(500, $response->getStatusCode());
            $this->assertEquals(false, $json['success']);
        }

    }