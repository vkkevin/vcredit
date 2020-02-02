<?php

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

if(is_readable(APP_CONFIG_PATH . 'Route.conf.php'))
    return include(APP_CONFIG_PATH . 'Route.conf.php');

return [
    'controller' => 'Index',
    'action' => 'index',
    'data' => []
];
