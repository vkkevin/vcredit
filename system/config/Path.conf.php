<?php

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

// 系统框架路径
defined('SYSTEM_PATH') or define('SYSTEM_PATH', BASE_PATH . 'system' . DIRECTORY_SEPARATOR);

defined('SYSTEM_CONFIG_PATH') or define('SYSTEM_CONFIG_PATH', SYSTEM_PATH . 'config' . DIRECTORY_SEPARATOR);

defined('SYSTEM_CORE_PATH') or define('SYSTEM_CORE_PATH', SYSTEM_PATH . 'core' . DIRECTORY_SEPARATOR);

defined('SYSTEM_LIB_PATH') or define('SYSTEM_LIB_PATH', SYSTEM_PATH . 'lib' . DIRECTORY_SEPARATOR);

defined('SYSTEM_FUNC_PATH') or define('SYSTEM_FUNC_PATH', SYSTEM_LIB_PATH . 'function' . DIRECTORY_SEPARATOR);

defined('SYSTEM_ROUTE_PATH') or define('SYSTEM_ROUTE_PATH', SYSTEM_PATH . 'router' . DIRECTORY_SEPARATOR);

defined('SYSTEM_DB_PATH') or define('SYSTEM_DB_PATH', SYSTEM_PATH . 'database' . DIRECTORY_SEPARATOR);

defined('SYSTEM_SECURITY_PATH') or define('SYSTEM_SECURITY_PATH', SYSTEM_PATH . 'security' . DIRECTORY_SEPARATOR);

// 应用路径
defined('MYAPP_PATH') or define('MYAPP_PATH', 'application');

defined('APP_PATH') or define('APP_PATH', BASE_PATH . MYAPP_PATH . DIRECTORY_SEPARATOR);

defined('APP_CORE_PATH') or define('APP_CORE_PATH', APP_PATH . 'core' . DIRECTORY_SEPARATOR);

defined('APP_CONTROLLER_PATH') or define('APP_CONTROLLER_PATH', APP_CORE_PATH . 'controller' . DIRECTORY_SEPARATOR);

defined('APP_MODEL_PATH') or define('APP_MODEL_PATH', APP_CORE_PATH . 'model' . DIRECTORY_SEPARATOR);

defined('APP_VIEW_PATH') or define('APP_VIEW_PATH', APP_CORE_PATH . 'view' . DIRECTORY_SEPARATOR);

defined('APP_CONFIG_PATH') or define('APP_CONFIG_PATH', APP_PATH . 'config' . DIRECTORY_SEPARATOR);

defined('APP_TEMPLATE_PATH') or define('APP_TEMPLATE_PATH', APP_PATH . 'template' . DIRECTORY_SEPARATOR);

defined('APP_STATIC_PATH') or define('APP_STATIC_PATH', APP_PATH . 'static' . DIRECTORY_SEPARATOR);

defined('APP_LIB_PATH') or define('APP_LIB_PATH', APP_PATH . 'lib' . DIRECTORY_SEPARATOR);

// 以下（相对）路径（相对与实例应用目录）会在 HTML文件中使用到
defined('APP_RELATIVE_PATH') or define('APP_RELATIVE_PATH', MYAPP_PATH . DIRECTORY_SEPARATOR);

defined('APP_STATIC_RELATIVE_PATH') or define('APP_STATIC_RELATIVE_PATH', APP_RELATIVE_PATH . 'static' . DIRECTORY_SEPARATOR);

defined('APP_CSS_PATH') or define('APP_CSS_PATH', APP_STATIC_RELATIVE_PATH . 'css' . DIRECTORY_SEPARATOR);

defined('APP_JS_PATH') or define('APP_JS_PATH', APP_STATIC_RELATIVE_PATH . 'js' . DIRECTORY_SEPARATOR);

defined('APP_IMAGE_PATH') or define('APP_IMAGE_PATH', APP_STATIC_RELATIVE_PATH . 'images' . DIRECTORY_SEPARATOR);

// 数据存储路径
defined('STORAGE_PATH') or define('STORAGE_PATH', BASE_PATH . 'storage' . DIRECTORY_SEPARATOR);

defined('CACHE_PATH') or define('CACHE_PATH', STORAGE_PATH . 'cache' . DIRECTORY_SEPARATOR);

defined('LOG_PATH') or define('LOG_PATH', STORAGE_PATH . 'log' . DIRECTORY_SEPARATOR);

// http 链接地址
defined('HTTP_PATH') or define('HTTP_PATH', $_SERVER['HTTP_HOST'] . '/mymgt' . DIRECTORY_SEPARATOR);
