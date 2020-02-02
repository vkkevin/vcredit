<?php
namespace System\Core;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

class Loader{
    public static $_nsMap = array(
        'System' => SYSTEM_PATH,
        'App' => APP_PATH
    );

    public static function autoload($class){
        //通过命名空间相应目录寻找
        $file = self::find_file($class);
        if($file && file_exists($file)) {
            self::include_file($file);
            return true;
        }

        //通过类Map查找
        $file = self::find_file_cmap($class);
        if($file && file_exists($file)) {
            self::include_file($file);
            return true;
        }

        debug_exit(__FILE__, __LINE__, $class . " load false\n");
        return false;
    }

    public static function find_file($class){
        $ns = substr($class, 0, strpos($class, '\\'));
        $filePath = '';
        if($ns) $filePath = self::$_nsMap[$ns];

        // 将命名空间转化为小写字母
        $tns = $ns;
        do{
            $class = ($tns)?substr($class, strlen($tns) + 1):$class;
            $tns = substr($class, 0, strpos($class, '\\'));
            $filePath = $filePath . (($tns)?(strtolower($tns).'\\'):'');
        }while($tns);

        $class = ($class[0]=='\\')?substr($class, 1):$class;
        $filePath = $filePath . $class . '.class.php';
        $filePath = strtr($filePath, '\\', DIRECTORY_SEPARATOR);
        return $filePath;
    }

    public static function find_file_cmap($class){
        $cmap = Loader::load_sys_conf('ClassMap');
        if(array_key_exists($class, $cmap))
            return $cmap[$class];
        return null;
    }

    public static function include_file($file){
        return self::__load_file($file);
    }

    public static function __load_file($fileName, $path = ''){
        if(is_readable($path . $fileName)){
            require_once($path . $fileName);
            return true;
        }

        $message = $path . $fileName . " is not exists or permission denied\n";
        debug_exit(__FILE__, __LINE__, $message);
        return false;
    }

    public static function __load_conf($confName, $path = '', $key = ''){
        if(empty($path)){
            $path = __DIR__ . DIRECTORY_SEPARATOR;
        }

        $fileName = $confName . '.conf.php';
        if(is_readable($path . $fileName)){
            $config = include($path . $fileName);
            if(empty($key) || $key == ''){
                return $config;
            }
            return $config[$key];
        }
        $message = $path . $fileName . " is not exists or permission denied\n";
        debug_exit(__FILE__, __LINE__, $message);
        return false;
    }

    public static function load_sys_conf($confName, $key = ''){
        return self::__load_conf($confName, SYSTEM_CONFIG_PATH, $key);
    }

    public static function load_app_conf($confName, $key = ''){
        return self::__load_conf($confName, APP_CONFIG_PATH, $key);
    }

    public static function load_func($funcName, $path = ''){
        if(empty($path)){
            $path = __DIR__ . DIRECTORY_SEPARATOR;
        }
        return self::__load_file($funcName . '.func.php', $path);
    }

    public static function load_sys_func($funcName){
        return self::load_func($funcName, SYSTEM_FUNC_PATH);
    }

    /**
     * 以下方法目前暂停使用
     * 建议使用 namespace 及 use 关键字
     */

    public static function load_class($className, $path = ''){
        if(empty($path)){
            $path = __DIR__ . DIRECTORY_SEPARATOR;
        }
        return self::__load_file($className . '.class.php', $path);
    }

    public static function load_lib($libName, $path = ''){
        if(empty($path)){
            $path = __DIR__ . DIRECTORY_SEPARATOR;
        }
        return self::__load_file($libName . '.lib.php', $path);
    }

    public static function load_sys_lib($libName){
        return self::load_lib($libName, SYSTEM_LIB_PATH);
    }

    public static function load_sys_controller(){
        return self::__load_file('Controller.class.php', SYSTEM_CORE_PATH);
    }

    public static function load_sys_model(){
        return self::__load_file('Model.class.php', SYSTEM_CORE_PATH);
    }

    public static function load_sys_view(){
        return self::__load_file('View.class.php', SYSTEM_CORE_PATH);
    }

    public static function load_app_controller($cName, $path = ''){
        if(empty($path)){
            $path = APP_CONTROLLER_PATH;
        }
        return self::__load_file($cName . 'Controller.class.php', $path);
    }

    public static function load_app_Model($mName, $path = ''){
        if(empty($path)){
            $path = APP_MODEL_PATH;
        }
        return self::__load_file($mName . 'Model.class.php', $path);
    }

    public static function load_app_View($vName, $path = ''){
        if(empty($path)){
            $path = APP_VIEW_PATH;
        }
        return self::__load_file($vName . 'View.class.php', $path);
    }

}