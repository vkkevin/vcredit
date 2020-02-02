<?php

namespace System\Core;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

class Log{
    public static $_config = array();

    public static function init(array $config = array()){
        self::$_config = $config;
    }

    public static function add_log_type($name, $path, $file){
        if(array_key_exists($name, self::$_config)){
            return false;
        }
        self::$_config[$name] = array(
            'path' => $path,
            'file' => $file
        );
        return true;
    }

    public static function del_log_type($name){
        if(array_key_exists($name, self::$_config))
            unset(self::$_config[$name]);
        return true;
    }

    public static function get_log_type(){
        return self::$_config;
    }

    private static function _log($message, $tag, $module){
        $tag = strtoupper($tag);
        $data = date('[Y-m-d H:i:s]').' '.$module.' ['.$tag.']: '.$message."\n";
        $ext = date('Ymd').'.log';
        $dir = self::$_config[$module]['path'];
        $file = self::$_config[$module]['file'] . $ext;

        if(!is_dir($dir) && !mkdir($dir,0755, true) ){
            return false;
        }

        return file_put_contents($dir . $file, $data, FILE_APPEND);
    }

    private static function file_to_message($file, $line, $message){
        if(($spath = find_spath($file)) !== false){
            $file = $spath;
        }

        return ($file.':'.$line.': '.$message);
    }

    public static function log($message, $tag = 'INFO', $module = 'default'){
        return self::_log($message, $tag, $module);
    }

    public static function system($message){
        return self::log($message, 'INFO', 'system');
    }

    public static function warning($file, $line, $message){
        $message = self::file_to_message($file, $line, $message);
        return self::log($message, 'WARNING', 'system');
    }

    public static function error($file, $line, $message){
        $message = self::file_to_message($file, $line, $message);
        return self::log($message, 'ERROR', 'system');
    }

    public static function notice($file, $line, $message){
        $message = self::file_to_message($file, $line, $message);
        return self::log($message, 'NOTICE', 'system');
    }

    public static function debug($file, $line, $message, $tag = 'DEBUG'){
        $message = self::file_to_message($file, $line, $message);
        return self::log($message, $tag, 'debug');
    }

    public static function app($message, $tag = 'INFO', $modele = 'app'){
        return self::log($message, $tag, $modele);
    }

    public static function visit($message, $module = 'app'){
        $messStr = $_SERVER['REMOTE_ADDR'].' '.$_SERVER['REQUEST_URI'].' '.$message;
        return self::log($messStr, 'INFO', $module);
    }
}
