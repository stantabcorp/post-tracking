<?php

use Psr\Container\ContainerInterface;

return [
    'settings.displayErrorDetails' => function (ContainerInterface $container) {
        return $container->get('debug');
    },
    'settings.debug' => function (ContainerInterface $container) {
        return $container->get('debug');
    }
];
