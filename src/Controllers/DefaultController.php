<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;

class DefaultController extends Controller {
    public function home(Response $response){
        return $response
            ->withJson([
                'name' => $this->container->get('app_name'),
                'environment' => $this->container->get('app_env'),
                'message' => 'This is the main page of the application'
            ]);
    }
}