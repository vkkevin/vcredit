<?php
namespace App\Core\View;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Core\View;

class IndexView extends View{
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
}