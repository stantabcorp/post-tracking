<?php
return [
    'app_name' => envOrDefault('APP_NAME', ''),
    'app_env' => envOrDefault('APP_ENV', ''),
    'debug' => envOrDefault('DEBUG', false) === 'true' || envOrDefault('DEBUG', false) === '1' ? true: false
];
