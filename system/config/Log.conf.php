<?php

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

$config = [
    'default' => [
        'driver' => 'file',
        'path' => LOG_PATH . 'default' . DIRECTORY_SEPARATOR,
        'file' => 'default',
    ],
    'system' => [
        'driver' => 'file',
        'path' => LOG_PATH . 'system' . DIRECTORY_SEPARATOR,
        'file' => 'system',
    ],
    'app' => [
        'driver' => 'file',
        'path' => LOG_PATH . 'app' . DIRECTORY_SEPARATOR,
        'file' => 'app',
    ],
    'debug' => [
        'driver' => 'file',
        'path' => LOG_PATH . 'debug' . DIRECTORY_SEPARATOR,
        'file' => 'debug',
    ],
    'custom' => [
        'driver' => 'file',
        'path' => LOG_PATH . 'custom' . DIRECTORY_SEPARATOR,
        'file' => 'custom',
    ]
];

return $config;