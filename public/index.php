<?php

use App\Utils\Service;

require '../vendor/autoload.php';

App\DotEnv::load();

$app = new \App\App();

Service::$path = "../Services";

$app->run();