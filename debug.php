<?php
defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

if(!defined('DEBUG') || DEBUG == false) {
    return;
}

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);


\System\Core\Loader::load_sys_func('Debug');