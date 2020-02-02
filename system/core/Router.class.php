<?php
namespace System\Core;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

abstract class Router{
    protected $_url;

    public function __construct($url){
        $this->_url = $url;
    }

    abstract public function route();

    abstract public function get_controller();

    abstract public function get_action();

    abstract public function get_data();

    abstract public function get_info();

    public function __destruct(){
        $this->_url = null;
    }
    
}