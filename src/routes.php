<?php

    $app->get('/', [\App\Controllers\DefaultController::class, 'home']);
    $app->get('/track', [\App\Controllers\DefaultController::class, 'track']);

    $app->group('/service/{service}', function(){
        $this->get('/track[/]', [\App\Controllers\ServicesController::class, 'track']);
    });