<?php

namespace System\Core;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

class Cache{
    // TODO: Code Cache Class
    public static $_config = array();

    public static function init(array $config = array()){
        self::$_config = $config;
    }

    public static function add_cache_module
    ($name, $driver, array $driver_info =  array()){
        if(array_key_exists($name, self::$_config)){
            return false;
        }

        if(array_key_exists($driver, $driver_info)){
            self::$_config[$name]['driver'] = $driver;
            self::$_config[$name]['info'] = $driver_info;
        }else{
            self::$_config[$name]['driver'] =
                self::$_config['default']['driver'];
            self::$_config[$name]['info'] = $driver_info;
            self::$_config[$name]['info']['file'] =
                self::$_config['default']['info']['file'];
        }
        return true;
    }

    public static function del_cache_module($name){
        if(array_key_exists($name, self::$_config))
            unset(self::$_config[$name]);
        return true;
    }

    public static function get_cache_module(){
        return self::$_config;
    }

    /** private */
    private static function format_data($data, $type){
        switch ($type){
            case 'string':
                $data = is_array($data)?array_to_string($data):$data;
                break;
            case 'json':
                $data = is_array($data)?$data:array($data);
                $data = json_encode($data);
                break;
            case 'array':
                $data = is_array($data)?$data:array($data);
                break;
            default:break;
        }
        return $data;
    }

    private static function _deposit_file($name, $value, $module, $flag){
        $path = self::$_config[$module]['info']['file']['path'];
        $type = self::$_config[$module]['info']['file']['type'];
        $ext = self::$_config[$module]['info']['file']['ext'];
        $file = $path . $name . $ext;

        if(!is_dir($path))
            mkdir($path, 0755, true);

        switch ($flag){
            case 'add':
                if(file_exists($file)) return false;
                break;
            case 'replace':
                if(!file_exists($file)) return false;
                break;
            case 'set':break;
            default:
                if(file_exists($file)) return false;
                break;
        }

        $value = self::format_data($value, $type);
        return file_put_contents($file, $value);
    }

    private static function _deposit_database($name, $value, $module, $flag){
        $cmodel = new DataModel(self::$_config[$module]['info']['database']['table']);
        $type = self::$_config[$module]['info']['database']['type'];

        $value = self::format_data($value, $type);
        $data = array('value' => $value);
        $ret = false;

        switch ($flag){
            case 'add':
                $data['name'] = $name;
                $ret = $cmodel->add_data($data);
                break;
            case 'replace':
                $ret = $cmodel->update_where($data, 'name = ' . $name);
                break;
            case 'set':
                if(!($cmodel->add_data($data)))
                    $ret = $cmodel->update_where($data, 'name = ' . $name);
                break;
            default:
                break;
        }
        unset($module);
        return $ret;
    }

    private static function _deposit_memcache($name, $value, $module, $flag){
        return false;
    }

    private static function _deposit($name, $value, $module, $flag = 'add'){
        if(!array_key_exists($module, self::$_config))
            $module = 'default';

        if(!array_key_exists('info', self::$_config[$module]))
            self::$_config[$module]['info'] = self::$_config['default']['info'];

        switch ($module){
            case 'file':return self::_deposit_file($name, $value, $module, $flag);break;
            case 'database':return self::_deposit_database($name, $value, $module, $flag);break;
            case 'memcache':return self::_deposit_memcache($name, $value, $module, $flag);break;
            default: break;
        }
        return false;
    }

    private static function _get_file($name, $module){
        $path = self::$_config[$module]['info']['file']['path'];
        $ext = self::$_config[$module]['info']['file']['ext'];
        $file = $path . $name . $ext;

        if(!file_exists($file))
            return false;
        return file_get_contents($file);
    }

    private static function _get_database($name, $module){
        $cmodel = new DataModel(self::$_config[$module]['info']['database']['table']);
        $data = $cmodel->get_data_by_name($name);
        unset($module);
        return $data;
    }

    private static function _get_memcache($name, $module){
        return false;
    }

    private static function _get($name, $module = 'default'){
        if(!array_key_exists($module, self::$_config))
            return null;

        if(!array_key_exists('info', self::$_config[$module]))
            return null;

        switch ($module){
            case 'file':return self::_get_file($name, $module);break;
            case 'database':return self::_get_database($name, $module);break;
            case 'memcache':return self::_get_memcache($name, $module);break;
            default: break;
        }
        return null;
    }

    private static function _delete_file($name, $module){
        $path = self::$_config[$module]['info']['file']['path'];
        $ext = self::$_config[$module]['info']['file']['ext'];
        $file = $path . $name . $ext;

        if(file_exists($file))
           return unlink($file);

        return false;
    }

    private static function _delete_database($name, $module){
        $cmodel = new DataModel(self::$_config[$module]['info']['database']['table']);
        $ret = $cmodel->del_data_by_name($name);
        unset($module);
        return $ret;
    }

    private static function _delete_memcache($name, $module){
        return false;
    }

    private static function _delete($name, $module = 'dafault'){
        if(!array_key_exists($module, self::$_config))
            return false;

        if(!array_key_exists('info', self::$_config[$module]))
            return false;

        switch ($module){
            case 'file':return self::_delete_file($name, $module);break;
            case 'database':return self::_delete_database($name, $module);break;
            case 'memcache':return self::_delete_memcache($name, $module);break;
            default: break;
        }
        return false;
    }

    /** public */
    public static function add($name, $value, $module = 'default'){
        return self::_deposit($name, $value, $module, __FUNCTION__);
    }

    public static function set($name, $value, $module = 'default'){
        return self::_deposit($name, $value, $module, __FUNCTION__);
    }

    public static function replace($name, $value, $module = 'default'){
        return self::_deposit($name, $value, $module, __FUNCTION__);
    }

    public static function get($name, $module = 'default'){
        return self::_get($name, $module);
    }

    public static function delete($name, $module = 'default'){
        return self::_delete($name, $module);
    }

    public static function clean($module = 'default'){
        return false;
    }

    public static function clean_all(){
        return false;
    }

}
