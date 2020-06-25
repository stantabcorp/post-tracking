<?php

    $this->get('/', [\App\Controllers\DefaultController::class, 'home']);
    $this->get('/track', [\App\Controllers\DefaultController::class, 'track']);

    $this->group('/service/{service}', function(){
        $this->get('/track[/]', [\App\Controllers\ServicesController::class, 'track']);
    });