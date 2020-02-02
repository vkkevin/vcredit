<?php
namespace App\Core\View;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Core\View;

class TestView extends View{
    public function __construct(){
        parent::__construct();
    }

    public function __destruct(){
        
    }

    public function index($item = ''){
        require_once(APP_TEMPLATE_PATH . 'index.html');
    }

    public function error($item = ''){
        require_once(APP_TEMPLATE_PATH . 'error/404Error.php');
    }

    public function custom($item = ''){
        if(!is_array($item))
            $item = array($item);

        $item['v'] = array_key_exists('v', $item)?$item['v']:'index';
        $item['ex'] = array_key_exists('ex', $item)?$item['ex']:'html';
        require_once(APP_TEMPLATE_PATH . "$item[v].$item[ex]");
    }

    public function top($item = ''){
        echo "Test 测试框架";
    }

    public function menu($item = array()){
        $menuStr = '';
        foreach ($item['methods'] as $method) {
            $methodName = $method->getName();
            $menuStr .= "<div>\n";
            $menuStr .= "<a href='?c=Test&a=content&class=$item[class]&method=$methodName' target='main'>\n";
            $menuStr .= $methodName . "\n";
            $menuStr .= "</a>\n";
            $menuStr .= "</div>\n";
        }
        echo $menuStr;
    }

    public function content($item = ''){

    }

    public function test($item = ''){
        require_once(APP_TEMPLATE_PATH . 'test/index.php');
    }
}