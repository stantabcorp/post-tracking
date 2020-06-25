<?php

    namespace App;

    class DotEnv
    {
        public static function load(): void
        {
            if (file_exists(dirname(__DIR__) . '/.env')) {
                \Dotenv\Dotenv::create(dirname(__DIR__))->load();
            }
        }
    }