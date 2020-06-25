<?php

namespace App\Controllers;

use App\Utils\Service;
use Psr\Container\ContainerInterface;

class Controller {
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}