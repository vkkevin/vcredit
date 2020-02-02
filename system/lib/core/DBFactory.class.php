<?php
namespace System\Lib\Core;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

class DBFactory{
    private static $_dbObj;

    public static function init($dbType, array $config = array()){
        $db = NS_SYSTEM_DB .'DB'.$dbType;
        self::$_dbObj = new $db($config);
    }

    public static function get_instance(){
        return self::$_dbObj;
    }

    public static function destroy(){
//        unset(self::$_dbObj);
        self::$_dbObj = null;
    }
}