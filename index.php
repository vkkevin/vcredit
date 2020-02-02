<?php
// 网站(框架)入口文件
header("Content-type:text/html;charset=utf-8");
isset($_SERVER) or exit('404 Page Not Find!');

// 根目录为当前目录
define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR);

// 调试选项
define('DEBUG', true);

// 自定义应用目录(相对路径)
// define('MYAPP_PATH', 'credit');

// 加载全局的配置文件
require_once(BASE_PATH . 'system/config/Global.conf.php');

// 实例化应用类
(new System\Core\Application())->run();
 