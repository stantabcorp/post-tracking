<?php
namespace App;

use DI\ContainerBuilder;

class App extends \DI\Bridge\Slim\App
{
    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions(__DIR__ . '/config/config.php');
        $builder->addDefinitions(__DIR__ . '/config/containers.php');
    }
}
