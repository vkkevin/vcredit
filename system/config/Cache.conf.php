<?php

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

/**
 * driver ==> file (default), database, memcache
 * info ==> drivers info
 */
$config = [
    'default' => [  // 此处可更改默认信息
        'driver' => 'file',
        'info' => [
            'file' => [
                'path' => CACHE_PATH . 'default' . DIRECTORY_SEPARATOR,
                'type' => 'json',   // json, array, string
                'ext' => '.cache',
            ],
            'database' => [
                'table' => 'cache_default',
                'type' => 'json',
            ],
            'memcache' => [],
        ],
    ],
    'system' => [
        'driver' => 'file',
        'info' => [
            'file' => [
                'path' => CACHE_PATH . 'system' . DIRECTORY_SEPARATOR,
                'type' => 'json',
                'ext' => '.cache',
            ],
            'database' => [
                'table' => 'cache_system',
                'type' => 'json',
            ],
            'memcache' => [],
        ],
    ],
    'app' => [
        'driver' => 'file',
        'info' => [
            'file' => [
                'path' => CACHE_PATH . 'app' . DIRECTORY_SEPARATOR,
                'type' => 'json',
                'ext' => '.cache',
            ],
            'database' => [
                'table' => 'cache_app',
                'type' => 'json',
            ],
            'memcache' => [],
        ],
    ],
    'custom' => [
        'driver' => 'file',
        'info' => [
            'file' => [
                'path' => CACHE_PATH . 'custom' . DIRECTORY_SEPARATOR,
                'type' => 'json',
                'ext' => '.cache',
            ],
            'database' => [
                'table' => 'cache_custom',
                'type' => 'json',
            ],
            'memcache' => [],
        ],
    ]
];

return $config;