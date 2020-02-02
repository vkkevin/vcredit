<?php
namespace System\Lib\Core;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

class RouterFactory{
    private static $_routerObj;

    public static function init($routerType, $url = ''){
        $router = NS_SYSTEM_ROUTE . $routerType . 'Router';
        self::$_routerObj = new $router($url);
    }

    public static function get_instance(){
        return self::$_routerObj;
    }

}
