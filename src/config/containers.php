<?php

use App\Utils\Cache;
use Psr\Container\ContainerInterface;

return [
    'settings.displayErrorDetails' => function (ContainerInterface $container) {
        return $container->get('debug');
    },
    'settings.debug' => function (ContainerInterface $container) {
        return $container->get('debug');
    },
    "cache" => function(ContainerInterface $container){
        $handler = null;
        if(getenv("CACHE_METHOD") == "file"){
            $handler = new \Lefuturiste\LocalStorage\LocalStorage(getenv("CACHE_FILE_PATH"));
        }else{
            $options = [];
            if(!empty(getenv("CACHE_REDIS_DATABASE"))){
                $options['parameters']['database'] = intval(getenv("CACHE_REDIS_DATABASE"));
            }
            if(!empty(getenv("CACHE_REDIS_PASSWORD"))){
                $options['parameters']['password'] = getenv("CACHE_REDIS_PASSWORD");
            }

            $handler = new \Predis\Client([
                'scheme' => getenv("CACHE_REDIS_SCHEME"),
                'host'   => getenv("CACHE_REDIS_HOST"),
                'port'   => intval(getenv("CACHE_REDIS_PORT")),
            ], $options);
        }
        return new Cache(getenv("CACHE_METHOD"), $handler);
    }
];
