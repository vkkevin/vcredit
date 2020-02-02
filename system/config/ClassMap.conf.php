<?php

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

if(is_readable(APP_CONFIG_PATH . 'ClassMap.conf.php')){
    $config = include(APP_CONFIG_PATH . 'ClassMap.conf.php');
}else{
    /* default */
    $config = [
        NS_SYSTEM_CORE . 'DataModel' => SYSTEM_CORE_PATH . 'Model.class.php'
    ];
}

return $config;