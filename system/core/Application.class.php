<?php
namespace System\Core;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Lib\Core\DBFactory;
use System\Lib\Core\RouterFactory;

final class Application{
    private $_info;// 'config', 'data'
    private $_router;

    public function __construct(){
        $this->init_config();
        $this->init_router();
        $this->init_DB();
        $this->init_controller();
        $this->init_log();
        $this->init_cache();
    }

    public function run(){
        $this->run_controller();
    }

    public function jump_url($url){
        header("Location: $_SERVER[REQUEST_SCHEME]://" . HTTP_PATH . $url);
    }

    protected function init_config(){
        $this->_info['config']['database'] = Loader::load_sys_conf('DB');
        $this->_info['config']['route'] = Loader::load_sys_conf('Route');
        $this->_info['config']['log'] = Loader::load_sys_conf('Log');
        $this->_info['config']['cache'] = Loader::load_sys_conf('Cache');
    }
    
    protected function init_router(){
        // RouterFactory
        RouterFactory::init('Parm', $_SERVER['REQUEST_URI']);
        $this->_router = RouterFactory::get_instance();
    }
    
    protected function init_DB(){
        // DBFactory
        DBFactory::init($this->_info['config']['database']['type'],
                        $this->_info['config']['database']);
    }

    protected function init_log(){
        Log::init($this->_info['config']['log']);
    }

    protected function init_cache(){
        Cache::init($this->_info['config']['cache']);
    }

    /* 从链接中筛选出控制器的字符串及其方法名 */
    protected function init_controller(){
        if($this->_router->get_controller() != ''){
            $this->_info['config']['route']['controller'] =
                $this->_router->get_controller();
        }
        if($this->_router->get_action() != ''){
            $this->_info['config']['route']['action'] =
                $this->_router->get_action();
        }
    }
    
    /* 根据控制器名实例化控制器并运行器方法 */
    protected function run_controller(){
        $controllerType = $this->_info['config']['route']['controller'];
        $action = $this->_info['config']['route']['action'];

        // 判断控制器和操作是否存在
        $controller = NS_APP_CONTROLLER . $controllerType . 'Controller';
        if (!class_exists($controller)) {
            if(defined('DEBUG') && DEBUG == true){
                exit($controller . ' is not exists');
            }
            $this->jump_url('index.php');
            exit();
        }
        if (!method_exists($controller, $action)) {
            if(defined('DEBUG') && DEBUG == true){
                exit($action . ' action is not exists');
            }
            $this->jump_url('index.php');
            exit();
        }

        /* 从网站信息中获取提交过来的数据 */
        $this->_info['data'] = $this->_router->get_data();
        
        $controllerObj = new $controller($this->_info['config'], $controllerType, $action);
        call_user_func_array(array($controllerObj, $action), array($this->_info['data']));
    }
}