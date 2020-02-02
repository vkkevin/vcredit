<?php
namespace App\Core\Controller;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Core\Controller;

class MemberController extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function __destruct(){

    }

    public function index(){

    }

    public function error(){
        require_once(APP_TEMPLATE_PATH . 'error/404Error.php');
    }
}