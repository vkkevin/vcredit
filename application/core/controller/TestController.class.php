<?php
namespace App\Core\Controller;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Core\Controller;
use App\Core\Model\TestModel;
use App\Core\View\TestView;
use System\Core\Log;

class TestController extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function __destruct(){

    }
    
    public function index($data = ''){
        // echo "Hello World!<br/>";
        // $view = new TestView();
        // $view->index($data);
        var_dump($_SERVER);
    }

    public function error($data = ''){
        $view = new TestView();
        $view->error($data);
    }

    public function custom($data = ''){
        $testView = new TestView();
        $testView->custom($data);
    }

    public function php_info(){
        phpinfo();
    }

    public function top($data = ''){
        $view = new TestView();
        $view->top($data);
    }

    public function menu($data = array()){
        if(!array_key_exists('class', $data)){
            $data['class'] = self::class;
        }

        $class = new \ReflectionClass($data['class']);
        $data['methods'] = $class->getMethods();
//        var_dump($data['methods']);

        $view = new TestView();
        $view->menu($data);
    }

    public function content($data = array()){
        if(!array_key_exists('class', $data)){
            $data['class'] = self::class;
        }
        if(!array_key_exists('method', $data)){
            $data['method'] = 'index';
        }

        $class = new \ReflectionClass($data['class']);
        // 相当于实例化 $data[class] 类
        $instance  = $class->newInstanceArgs();
        if($class->hasMethod($data['method'])){
            // 获取 $data[class] 类中的 $data[method] 方法
            $method = $class->getMethod($data['method']);
            $method->invoke($instance);    // 执行 $data[method] 方法
        }

        // $view = new TestView();
        // $view->content($data);
    }

    public function test($data = array()){
        if(!array_key_exists('class', $data)) {
            $data['class'] = self::class;
        }
        $view = new TestView();
        $view->test($data);
    }

    public function test_db(){
        $model = new TestModel();
        $item['test'] = $model->test_select();
        // var_dump($item['test']);
        // $item['test'] = $model->test_update();
        // $item['test'] = $model->test_insert();
        // $item['test'] = $model->test_delete();
    }

    public function test_log($data = ''){
        Log::add_log_type('test','/tmp/test','test');
        var_dump( Log::get_log_type() );
    }

    public function test_call_func(){
        call_user_func_array(array($this, 'test_log'),
            array(array(123,345),456,789));
    }

    public function test_debug(){
//        var_dump(find_spath(__FILE__));
    }
}