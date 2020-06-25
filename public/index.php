<?php

require '../vendor/autoload.php';

if (file_exists('../.env')) {
    $dotEnv = new \Dotenv\Dotenv(dirname(__DIR__));
    $dotEnv->load();
}

require '../src/bootstrap/functions.php';

$app = new \App\App();

require '../src/routes.php';

$app->run();