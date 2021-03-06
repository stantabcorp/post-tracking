<?php

namespace App\Controllers;

use App\Utils\Service;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Response;

class DefaultController extends Controller {
    public function home(Request $request, Response $response){

        $service = new Service;

        return $response
            ->withJson([
                "success" => true,
                "services" => $service->listServices(),
            ]);
    }

    public function track(Request $request, Response $response){
        if(!isset($request->getQueryParams()['code'])){
            return $response->withJson([
                "success" => false,
                "errors" => ["code parameter is missing"]
            ])->withStatus(400);
        }

        $cache = $this->container->get("cache");
        $cache->removeOlderElements();

        if($cache->has("track:" . $request->getQueryParams()['code'])){
            return $response->withJson([
                "success" => true,
                "tracking" => $cache->get("track:" . $request->getQueryParams()['code'])
            ]);
        }

        $serviceHelper = new Service;
        $result = $serviceHelper->track($request->getQueryParams()['code']);
        if($result === false){
            return $response->withJson([
                "success" => false,
                "errors" => ["Tracking error"]
            ])->withStatus(500);
        }
        if($result === null){
            return $response->withJson([
                "success" => false,
                "errors" => ["Service not found"]
            ])->withStatus(404);
        }

        $cache->set("track:" . $request->getQueryParams()['code'], $result);

        return $response->withJson([
            "success" => true,
            "tracking" => $result,
        ]);
    }
}