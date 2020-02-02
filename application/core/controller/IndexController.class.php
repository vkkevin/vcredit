<?php
namespace App\Core\Controller;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Core\Controller;
use App\Core\View\IndexView;

class IndexController extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function __destruct(){

    }

    public function index($data = ''){
        $view = new IndexView();
        $view->index($data);
    }

    public function error($data = ''){
        $view = new IndexView();
        $view->index($data);
    }
}