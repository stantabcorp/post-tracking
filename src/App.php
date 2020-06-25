<?php
namespace App;

use DI\ContainerBuilder;

class App extends \DI\Bridge\Slim\App
{

    public function __construct()
    {
        parent::__construct();

        require 'routes.php';
    }

    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions(__DIR__ . '/config/config.php');
        $builder->addDefinitions(__DIR__ . '/config/containers.php');
    }
}
