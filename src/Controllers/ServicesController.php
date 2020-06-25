<?php

namespace App\Controllers;

use App\Utils\Service;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Response;

class ServicesController extends Controller {

    public function track(Request $request, Response $response, $service){
        if(!isset($request->getQueryParams()['code'])){
            return $response->withJson([
                "success" => false,
                "errors" => ["code parameter is missing"]
            ])->withStatus(400);
        }

        $serviceHelper = new Service;
        $service = $serviceHelper->find($service);
        if($service == null){
            return $response->withJson([
                "success" => false,
                "errors" => ["Service not found"]
            ])->withStatus(404);
        }

        $result = $service->track($request->getQueryParams()['code']);
        if($result === false){
            return $response->withJson([
                "success" => false,
                "errors" => ["Tracking error"]
            ])->withStatus(500);
        }

        return $response->withJson([
            "success" => true,
            "tracking" => $result,
        ]);
    }

}