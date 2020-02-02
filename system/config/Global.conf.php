<?php
/**
 * 该文件用于加载全局的配置文件
 * @author Kevin
 * @date 8-28-2018
 */

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

// 加载全局路径
require_once(BASE_PATH . 'system/config/Path.conf.php');

// 类自动加载机制
require_once(SYSTEM_CORE_PATH . 'Loader.class.php');
spl_autoload_register('System\Core\Loader::autoload');

// 加载命名空间
require_once(SYSTEM_CONFIG_PATH . 'Namespace.conf.php');

// 加载全局函数库
require_once(SYSTEM_FUNC_PATH . 'Global.func.php');

// 加载调试文件
require_once(BASE_PATH . 'debug.php');

// 加载应用层全局配置文件
if(is_readable(APP_CONFIG_PATH . 'Global.conf.php')) {
    require_once(APP_CONFIG_PATH . 'Global.conf.php');
}
