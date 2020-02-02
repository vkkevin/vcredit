<?php
namespace System\Core;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

abstract class View{
    public function __construct(){

    }

    public function __destruct(){

    }

    public abstract function index();

    public abstract function error();
}