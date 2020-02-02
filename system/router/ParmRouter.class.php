<?php
namespace System\Router;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Core\Router;

class ParmRouter extends Router{
    private $_info;

    public function __construct($url){
        parent::__construct($url);
        $this->_info = ['c'=>'','a'=>'','data'=>[]];
        $this->route();
        $this->filtering_data();
    }

    /* 分析 url 字符串并把信息存储在 $_info 中 */
    public function route(){
        $pos = strpos($this->_url, '?');
        $url = ($pos === false ? $this->_url : substr($this->_url, $pos));
        $url = trim($url, '?');

        $info = [];
        do{
            $pos = strpos($url, '&');
            array_push($info, $pos === false ? $url : substr($url, 0, $pos));
            $url = ($pos === false ? $url : substr($url, $pos));
            $url = trim($url, '&');
        }while($pos != false);

        foreach($info as $str){
            $pos = strpos($str, '=');
            $key = ($pos === false ? $str : substr($str, 0, $pos));
            $value = trim($pos === false ? $str : substr($str, $pos), '=');
            if($key == 'c' || $key == 'a'){
                $this->_info[$key] = $value;
            }else{
                $this->_info['data'][$key] = $value;
            }
        }
    }

    public function filtering_data(){
        foreach($_GET as $k => $v){
            if($k != 'c' && $k != 'a'){
                $this->_info['data'][$k] = $v;
            }
        }

        foreach($_POST as $k => $v){
            $this->_info['data'][$k] = $v;
        }
    }

    public function get_controller(){
        return $this->_info['c'];
    }

    public function get_action(){
        return $this->_info['a'];
    }

    public function get_data(){
        if(!isset($this->_info['data']))
            return array();
        return $this->_info['data'];
    }

    public function get_info(){
        return $this->_info;
    }

    public function __destruct(){
        // parent::__destruct();
    }

}