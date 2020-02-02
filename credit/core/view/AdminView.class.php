<?php
namespace App\Core\View;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Core\View;

class AdminView extends View{
    public function __construct(){
        parent::__construct();
    }
    
    public function __destruct(){
        
    }
    
    public function index($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/index.php');
    }

    public function error($item = ''){

    }

    public function login($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/login.php');
    }
    
    public function top($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/top.php');
    }
    
    public function menu($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/menu.php');
    }

    public function content($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/content.php');
    }

    public function blank($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/blank.php');
    }

    public function alert_message($message){
        echo "<script>alert('$message');</script>";
    }

    public function change_password_page($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/change_password.php');
    }

    public function change_password($item = ''){
        if($item['result'] == true){
            echo "<script>alert('密码修改成功');</script>";
        }else{
            echo "<script>alert('密码修改失败');</script>";
        }
        echo "<script>location.href='?c=Admin&a=change_password';</script>";
    }

    public function access_denied($item = ''){
        echo "<script>alert('对不起，您没有权限访问！');</script>";
        exit();
    }

    /**
     * 学生管理模块
     */
    public function show_student($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/show_student.php');
    }

    public function search_student($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/search_student.php');
    }

    public function list_student($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/student_list.php');
    }

    public function add_student_page($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/add_student_page.php');
    }

    public function add_student($item){
        $result = $item['result'];
        if($result == true){
            echo "<script>alert('添加成功');</script>";
            echo "<script>location.href='?c=Admin&a=list_student';</script>";
        }else{
            echo "<script>alert('添加失败');</script>";
            echo "<script>location.href='?c=Admin&a=add_student';</script>";
        }
    }

    public function del_student($item){
        $result = $item['result'];
        if($result == true){
            echo "<script>alert('删除成功');</script>";
        }else{
            echo "<script>alert('删除失败');</script>";
        }
        echo "<script>location.href='?c=Admin&a=list_student';</script>";
    }

    public function change_student_page($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/change_student_page.php');
    }

    public function change_student($item){
        if($item['result'] == true){
            echo "<script>alert('修改成功');</script>";
        }else{
            echo "<script>alert('修改失败');</script>";
        }
        echo "<script>location.href='?c=Admin&a=list_student';</script>";
    }

    /**
     * 活动管理模块
     */
    public function show_activity($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/show_activity.php');
    }

    public function search_activity($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/search_activity.php');
    }

    public function list_activity($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/activity_list.php');
    }

    public function add_activity_page($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/add_activity_page.php');
    }

    public function add_activity($item){
        $result = $item['result'];
        if($result == true){
            echo "<script>alert('添加成功');</script>";
            echo "<script>location.href='?c=Admin&a=list_activity';</script>";
        }else{
            echo "<script>alert('添加失败');</script>";
            echo "<script>location.href='?c=Admin&a=add_activity';</script>";
        }
    }

    public function del_activity($item){
        $result = $item['result'];
        if($result == true){
            echo "<script>alert('删除成功');</script>";
        }else{
            echo "<script>alert('删除失败');</script>";
        }
        echo "<script>location.href='?c=Admin&a=list_activity';</script>";
    }

    public function change_activity_page($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/change_activity_page.php');
    }

    public function change_activity($item){
        if($item['result'] == true){
            echo "<script>alert('修改成功');</script>";
        }else{
            echo "<script>alert('修改失败');</script>";
        }
        echo "<script>location.href='?c=Admin&a=list_activity';</script>";
    }

    /**
     * 学分认定管理模块
     */
    public function show_credit($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/show_credit.php');
    }

    public function list_credit_need($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/credit_need_list.php');
    }

    public function list_credit_adopt($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/credit_adopt_list.php');
    }

    public function list_credit_veto($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/credit_veto_list.php');
    }

    public function affirm_credit($item = ''){
        $result = $item['result'];
        if($result == true){
            echo "<script>alert('认定成功');</script>";
        }else{
            echo "<script>alert('认定失败');</script>";
        }
        echo "<script>location.href='?c=Admin&a=list_credit_adopt';</script>";
    }

    public function veto_credit($item = ''){
        $result = $item['result'];
        if($result == true){
            echo "<script>alert('否决成功');</script>";
        }else{
            echo "<script>alert('否决失败');</script>";
        }
        echo "<script>location.href='?c=Admin&a=list_credit_veto';</script>";
    }

    public function del_credit($item = ''){
        $result = $item['result'];
        if($result == true){
            echo "<script>alert('删除成功');</script>";
        }else{
            echo "<script>alert('删除失败');</script>";
        }
        echo "<script>location.href='?c=Admin&a=list_credit_veto';</script>";
    }

    public function add_credit_cogizance_page($item = ''){
        require_once(APP_TEMPLATE_PATH . 'admin/add_credit_page.php');
    }

    public function add_credit_cogizance($item = ''){
        $result = $item['result'];
        if($result == true){
            echo "<script>alert('添加成功');</script>";
        }else{
            echo "<script>alert('添加失败');</script>";
        }
        echo "<script>location.href='?c=Admin&a=list_credit_need';</script>";
    }

    public function change_credits_batch_page($item = ''){
        // TODO: 编写批量修改学分信息页面
        require_once(APP_TEMPLATE_PATH . 'test/change_credit_batch_page.php');
    }

    public function change_credits_batch($item = ''){
        if($item['result'] == true){
            echo "<script>alert('修改成功');</script>";
        }else{
            echo "<script>alert('修改失败');</script>";
        }
        echo "<script>location.href='?c=Admin&a=show_activity&id=$item[activity_id]';</script>";
    }

    public function change_add_credits_batch_page($item = ''){
        // TODO: 编写批量增加学分信息页面
        require_once(APP_TEMPLATE_PATH . 'test/change_add_credit_batch_page.php');
    }

    public function change_add_credits_batch($item = ''){
        if($item['result'] == true){
            echo "<script>alert('学分添加成功');</script>";
        }else{
            echo "<script>alert('学分添加失败');</script>";
        }
        echo "<script>location.href='?c=Admin&a=show_activity&id=$item[activity_id]';</script>";
    }

    public function no_select_student($item = ''){
        echo "<script>alert('没有选择的学生');";
        echo "location.href='?c=Admin&a=show_activity&id=$item[activity_id]';</script>";
    }
}