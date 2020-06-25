<?php
return [
    'app_name' => getenv('APP_NAME'),
    'app_env' => getenv('APP_ENV'),
    'debug' => getenv('DEBUG') === 'true' || getenv('DEBUG') === '1' ? true: false
];
