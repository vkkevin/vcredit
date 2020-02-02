<?php
namespace App\Core\Controller;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Core\Loader;
use System\Core\Controller;
use App\Core\Model\AdminModel;
use App\Core\View\AdminView;

use App\Core\Model\StudentManageModel;
use App\Core\Model\CreditManageModel;
use App\Core\Model\ActivityManageModel;

class AdminController extends Controller{
    private $_id;
    private $_name;
    private $_role;

    public function __construct(){
        parent::__construct();
        $this->is_online();
    }

    public function __destruct(){
    }

    public function index($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        $adminView->index($data);
    }

    public function error($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        $adminView->error($data);
    }

    public function top($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        $data['name'] = $this->_name;
        $data['role'] = $this->_role;
        $adminView->top($data);
    }
    
    public function menu($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');

        $data['menu'] = Loader::load_app_conf('AdminMenu', $this->_role);
        $adminView->menu($data);
    }
    
    public function content($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        $adminView->content($data);
    }
    
    public function blank($data = ''){
        $adminView = new AdminView();
        $adminView->blank($data);
    }

    public function login($data = ''){
        $adminView = new AdminView();
        if($this->validate_online() == true){
            $adminView->index($data);
            return true;
        }
        $adminView->login($data);
        return false;
    }
    
    public function validate_login($data = ''){
        if(!is_array($data) || $data == '' || count($data) == 0){
            exit("<script>
                location.href='?c=Admin&a=login';
            </script>");
        }
        $adminModel = new AdminModel();
        $adminData = $adminModel->get_info_by_id($data['userid']);
        // $adminData = $adminModel->get_info_by_name($data['username']);

        if(!is_array($adminData) || $adminData == null){
            exit("<script>
                alert('用户名或ID错误！');
                location.href='?c=Admin&a=login';
            </script>");
        }
        if($data['password'] != $adminData['password']){
            exit("<script>
                alert('密码错误！');
                location.href='?c=Admin&a=login';
            </script>");
        }

        $this->_id = $adminData['id'];
        $this->_name = $adminData['name'];
        $this->_role = $adminData['role'];
        /* 设置 cookie 和 session */
        if(!session_id())
            session_start();
        $_SESSION['adminInfo'] = [  "id"=>$this->_id,
                                    "name"=>$this->_name,
                                    "role"=>$this->_role,
                                    "isLogin"=>true ];
        $validateValue = md5($_SESSION['adminInfo']['name'].$_SESSION['adminInfo']['role']);
        setcookie("_vv_", $validateValue);
        exit("<script>
            alert('登录成功');
            location.href='?c=Admin&a=index';
        </script>");
    }
    
    private function is_online(){
        // 使用到 cookie 和 session
        if(!session_id()){
            session_start();
        }
        if(!isset($_SESSION['adminInfo'])){
            return false;
        }
        $validateValue = md5($_SESSION['adminInfo']['name'].$_SESSION['adminInfo']['role']);
        if($validateValue == $_COOKIE['_vv_'] && $_SESSION['adminInfo']['isLogin'] == true){
            $this->_id = $_SESSION['adminInfo']['id'];
            $this->_name = $_SESSION['adminInfo']['name'];
            $this->_role = $_SESSION['adminInfo']['role'];
            return true;
        }
        return false;
    }

    private function validate_online(){
        if($this->is_online()){
            return true;
        }
        return false;
    }

    public function logout($data = ''){
        if(!session_id())
            session_start();
        $_SESSION = [];

        if(ini_get("session.use_cookies")){
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]);
            setcookie("_vv_", '', time() - 42000);
        }

        session_destroy();
        exit("<script>
            alert('退出登录');
            location.href='?c=Admin&a=login';
        </script>");
    }

    public function validate_permission($module, $operation = ''){
        $parr = Loader::load_app_conf('AdminPermission', $this->_role);
        if(array_key_exists($module, $parr)){
            if($operation != '' && !in_array($operation, $parr[$module])){
                return false;
            }
            return true;
        }
        return false;
    }

    public function validate_jump($data = '', $url = ''){
        if($this->validate_online() == false){
            echo "<script type='text/javascript'>\n";
            echo "alert('未检测到登录信息，请先登录');\n";
            echo "window.parent.location.href='$url';\n";
            echo "</script>\n";
            // return false;
            exit();
        }
        return true;
    }

    public function change_password($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        $adminView->change_password_page($data);
    }

    public function change_password_exec($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        $adminModel = new AdminModel();
        $adminData = $adminModel->get_info_by_id($this->_id);

        if($data['password']['old'] != $adminData['password']){
            $adminView->alert_message("原密码错误，请重新输入！");
            echo "<script>location.href='?c=Admin&a=change_password'</script>";
            return false;
        }

        if($data['password']['new1'] != $data['password']['new2']){
            $adminView->alert_message("两次密码不一致！");
            echo "<script>location.href='?c=Admin&a=change_password'</script>";
            return false;
        }

        if($data['password']['new1'] == ''){
            $adminView->alert_message("密码不能为空！");
            echo "<script>location.href='?c=Admin&a=change_password'</script>";
            return false;
        }

        $data['result'] = $adminModel->reset_password($this->_id, $data['password']['new1']);
        $adminView->change_password($data);
        return true;
    }

    /**
     *  学生管理模块
     */
    public function show_student($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_student')){
            $adminView->access_denied();
        }

        $stuMgtModel = new StudentManageModel();
        $data['student'] = $stuMgtModel->get_info_by_id($data['id']);
        $data['student']['total_credit'] = $stuMgtModel->get_total_credit_by_id($data['id']);

        $cdtMgtModel = new CreditManageModel();
        $wheredata = ['student_id' => $data['id'], "cogizance_state" => '2'];
        $data['credits'] = $cdtMgtModel->get_info_detailed_where_arr($wheredata);
        unset($data['id']);
        $adminView->show_student($data);
    }

    public function add_student($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_student')){
            $adminView->access_denied();
        }
        $adminView->add_student_page($data);    
    }
    
    public function add_student_exec($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_student')){
            $adminView->access_denied();
        }
        $stuMgtModel = new StudentManageModel();
        $item['result'] = $stuMgtModel->add_info($data['stuInfo']);
        $adminView->add_student($item);
    }

    public function list_student($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_student')){
            $adminView->access_denied();
        }
        if(!isset($data['p'])){
            $data['p'] = 1;
        }
        $item['page'] = $data['p'];
        $stuMgtModel = new StudentManageModel();
        $item['students'] = $stuMgtModel->get_info_by_lim((($data['p']-1)*10).',10');
        $item['stu_num'] = $stuMgtModel->get_info_num();
        $adminView->list_student($item);
    }

    public function search_student($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_student')){
            $adminView->access_denied();
        }
        if($data['where']['s_name'] == '' && $data['where']['s_id'] == '' 
                && $data['where']['s_condition_text'] == ''){
            $this->list_student($data);
            return;
        }

        $stuMgtModel = new StudentManageModel();
        $where_data['name'] = $data['where']['s_name'];
        $where_data['id'] = $data['where']['s_id'];
        $where_data[$data['where']['s_condition']] = $data['where']['s_condition_text'];
        $item['where'] = $data['where'];
        $item['students'] = $stuMgtModel->get_info_where($where_data);
        $item['stu_num'] = $stuMgtModel->get_info_num($where_data);
        $adminView->search_student($item);
    }

    public function del_student($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_student')){
            $adminView->access_denied();
        }
        $stuMgtModel = new StudentManageModel();
        $item['result'] = $stuMgtModel->del_info_by_id($data['id']);
        $adminView->del_student($item);
        return $item['result'];
    }

    public function del_student_batch($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_student')){
            $adminView->access_denied();
        }
        $delFlage = true;
        $stuMgtModel = new StudentManageModel();
        $stuIds = $data['check_data'];
        foreach($stuIds as $id){
            if( $stuMgtModel->del_info_by_id($id) == false ){
                $leaveIds[] = $id;
                $delFlage = false;
            }
        }
        $item['leaveIds'] = $leaveIds;
        $item['result'] = $delFlage;

        $adminView->del_student($item);
        return $delFlage;
    }

    public function change_student($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_student')){
            $adminView->access_denied();
        }
        $stuMgtModel = new StudentManageModel();
        $data['student'] = $stuMgtModel->get_info_by_id($data['id']);
        $data['student']['id'] = $data['id'];
        $adminView->change_student_page($data);
    }

    public function change_student_exec($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_student')){
            $adminView->access_denied();
        }
        $stuMgtModel = new StudentManageModel();
        $item['result'] = $stuMgtModel->update($data['stuInfo']);
        $adminView->change_student($item);
    }

    /**
     * 活动管理模块
     */
    public function show_activity($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_activity')){
            $adminView->access_denied();
        }

        $actMgtModel = new ActivityManageModel();
        $data['activity'] = $actMgtModel->get_info_by_id($data['id']);
        $data['students'] = $actMgtModel->get_participator_by_actId($data['id']);

        $cdtMgtModel = new CreditManageModel();
        $wheredata = ['activity_id' => $data['id'], 'cogizance_state' => '2'];
        $data['credits']['adopt'] = $cdtMgtModel->get_info_detailed_where_arr($wheredata);
        $wheredata = ['activity_id' => $data['id'], 'cogizance_state' => ['0', '1']];
        $data['credits']['need'] = $cdtMgtModel->get_info_detailed_where_arr($wheredata);
        $data['activity']['actual_people_number'] = $cdtMgtModel->get_info_num($wheredata);
        unset($data['id']);
        $adminView->show_activity($data);
    }

    public function add_activity($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_activity')){
            $adminView->access_denied();
        }
        $actMgtModel = new ActivityManageModel();
        $data['typeInfo'] = $actMgtModel->get_type_info();
        $adminView->add_activity_page($data);
    }

    public function add_activity_exec($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_activity')){
            $adminView->access_denied();
        }
        $actMgtModel = new ActivityManageModel();
        $item['result'] = $actMgtModel->add_info($data['actInfo']);
        $adminView->add_activity($item);
    }

    public function list_activity($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_activity')){
            $adminView->access_denied();
        }
        if(!isset($data['p'])){
            $data['p'] = 1;
        }
        $item['page'] = $data['p'];

        $actMgtModel = new ActivityManageModel();
        $item['activities'] = $actMgtModel->get_info_by_lim((($data['p']-1)*10).',10');
        $item['act_num'] = $actMgtModel->get_info_num();

        $cdtMgtModel = new CreditManageModel();
        foreach($item['activities'] as &$act){
            $wheredata = ['activity_id' => $act['id'], 'cogizance_state' => '2'];
            $act['actual_people_number'] = $cdtMgtModel->get_info_num($wheredata);
        }
        $adminView->list_activity($item);
    }

    public function search_activity($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_activity')){
            $adminView->access_denied();
        }
        if($data['where']['s_name'] == '' && $data['where']['s_condition_text'] == ''){
            $this->list_activity($data);
            return;
        }

        $actMgtModel = new ActivityManageModel();
        $where_data['name'] = $data['where']['s_name'];
        $where_data[$data['where']['s_condition']] = $data['where']['s_condition_text'];
        $item['where'] = $data['where'];
        $item['activities'] = $actMgtModel->get_info_where($where_data);
        $item['act_num'] = $actMgtModel->get_info_num($where_data);
        $adminView->search_activity($item);
    }

    public function del_activity($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_activity')){
            $adminView->access_denied();
        }
        $actMgtModel = new ActivityManageModel();
        $item['result'] = $actMgtModel->del_info_by_id($data['id']);
        $adminView->del_activity($item);
        return $item['result'];
    }

    public function del_activity_batch($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_activity')){
            $adminView->access_denied();
        }
        $delFlage = true;
        $actMgtModel = new ActivityManageModel();
        $actIds = $data['check_data'];
        foreach($actIds as $id){
            if( $actMgtModel->del_info_by_id($id) == false ){
                $leaveIds[] = $id;
                $delFlage = false;
            }
        }
        $item['leaveIds'] = $leaveIds;
        $item['result'] = $delFlage;

        $adminView->del_activity($item);
        return $delFlage;
    }

    public function change_activity($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_activity')){
            $adminView->access_denied();
        }
        $actMgtModel = new ActivityManageModel();
        $data['activity'] = $actMgtModel->get_info_by_id($data['id']);
        $data['typeInfo'] = $actMgtModel->get_type_info();
        $data['activity']['id'] = $data['id'];
        $adminView->change_activity_page($data);
    }

    public function change_activity_exec($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_student')){
            $adminView->access_denied();
        }

        $actMgtModel = new ActivityManageModel();
        $item['result'] = $actMgtModel->update($data['actInfo']);
        $adminView->change_activity($item);
    }

    /**
     * 学分认定管理模块
     */
    public function show_credit($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_credit')){
            $adminView->access_denied();
        }

        $cdtMgtModel = new CreditManageModel();
        $data['credit'] = $cdtMgtModel->get_info_by_id($data['id']);
        unset($cdtMgtModel);

        $stuMgtModel = new StudentManageModel();
        $data['student'] = $stuMgtModel->get_info_by_id($data['credit']['student_id']);
        unset($stuMgtModel);

        $actMgtModel = new ActivityManageModel();
        $data['activity'] = $actMgtModel->get_info_by_id($data['credit']['activity_id']);
        unset($actMgtModel);

        unset($data['id']);
        $adminView->show_credit($data);
    }

    public function add_credit_cogizance($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_credit', 'add_credit')){
            $adminView->access_denied();
        }
        $actMgtModel = new ACtivityManageModel();
        $data['activities'] = $actMgtModel->get_all();
        $adminView->add_credit_cogizance_page($data);
    }

    public function add_credit_cogizance_exec($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_credit', 'add_credit')){
            $adminView->access_denied();
        }

        $actMgtModel = new ActivityManageModel();
        if($actMgtModel->get_participator_num_by_2id(
            $data['cdtInfo']['activity_id'], $data['cdtInfo']['student_id']) < 1){
            $adminView->add_credit_cogizance(['result' => false]);
            return;
        }

        $dt = new DateTime();
        $data['cdtInfo']['submit_id'] = $this->_id;
        $data['cdtInfo']['submit_time'] = $dt->format('Y-m-d H:i:s');
        $data['cdtInfo']['cogizance_state'] = '1';
        $cdtMgtModel = new CreditManageModel();
        $item['result'] = $cdtMgtModel->add_info($data['cdtInfo']);
        $adminView->add_credit_cogizance($item);
    }

    private function list_credit($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_credit')){
            $adminView->access_denied();
        }
        if(!isset($data['p'])){
            $data['p'] = 1;
        }
        $item['page'] = $data['p'];
        $item['role'] = $this->_role;
        $cdtMgtModel = new CreditManageModel();
        $item['credits'] = $cdtMgtModel->get_info_detailed_where($data['where'], (($data['p']-1)*10).',10');
        $item['cdt_num'] = $cdtMgtModel->get_info_detailed_num($data['where']);
        return $item;
    }

    public function list_credit_need($data = ''){   // 0, 1
        $adminView = new AdminView();
        switch($this->_role){
            case 'normal':
                $data['where'] = "submit_id='$this->_id' AND (cogizance_state='0' OR cogizance_state='1')";
                break;
            case 'svip':
                $data['where'] = "cogizance_state='0' OR cogizance_state='1'";
                break;
            default:
                $this->login($data);
                exit();
        }
        $item = $this->list_credit($data);
        $adminView->list_credit_need($item);
    }

    public function list_credit_adopt($data = ''){  // 2
        $adminView = new AdminView();
        switch($this->_role){
            case 'normal':
                $data['where'] = "submit_id='$this->_id' AND cogizance_state='2'";
                break;
            case 'svip':
                $data['where'] = "cogizance_state='2'";
                break;
            default:
                $this->login($data);
                exit();
        }
        $item = $this->list_credit($data);
        $adminView->list_credit_adopt($item);
    }

    public function list_credit_veto($data = ''){   // -1
        $adminView = new AdminView();
        switch($this->_role){
            case 'normal':
                $data['where'] = "submit_id='$this->_id' AND cogizance_state='-1'";
                break;
            case 'svip':
                $data['where'] = "cogizance_state='-1'";
                break;
            default:
                $this->login($data);
                exit();
        }
        $item = $this->list_credit($data);
        $adminView->list_credit_veto($item);
    }

    public function affirm_credit($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_credit', 'affirm_credit')){
            $adminView->access_denied();
        }
        $cdtMgtModel = new CreditManageModel();
        $data['result'] = $cdtMgtModel->affirm_credit_svip($data['id'], $this->_id);
        $adminView->affirm_credit($data);
    }

    public function veto_credit($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_credit', 'veto_credit')){
            $adminView->access_denied();
        }
        $cdtMgtModel = new CreditManageModel();
        $data['result'] = $cdtMgtModel->veto_credit($data['id'], $this->_id);
        $adminView->veto_credit($data);
    }

    public function del_credit($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_credit', 'del_credit')){
            $adminView->access_denied();
        }
        $cdtMgtModel = new CreditManageModel();
        $item['result'] = $cdtMgtModel->del_info_by_id($data['id']);
        $adminView->del_credit($item);
        return $item['result'];
    }

    public function del_credit_batch($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_credit', 'del_credit')){
            $adminView->access_denied();
        }
        $delFlage = true;
        $cdtMgtModel = new CreditManageModel();
        $actIds = $data['check_data'];
        foreach($actIds as $id){
            if( $cdtMgtModel->del_info_by_id($id) == false ){
                $leaveIds[] = $id;
                $delFlage = false;
            }
        }
        $item['leaveIds'] = $leaveIds;
        $item['result'] = $delFlage;

        $adminView->del_activity($item);
        return $delFlage;
    }

    private function search_credit($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_credit')){
            $adminView->access_denied();
        }

        $cdtMgtModel = new CreditManageModel();
        if($data['where']['s_sid'] != ''){
            $where_data['student_id'] = $data['where']['s_sid'];
        }
        if($data['where']['s_condition_text'] != ''){
            $where_data[$data['where']['s_condition']] = $data['where']['s_condition_text'];
        }

        $where_data['cogizance_state'] = $data['where']['cogizance_state'];
        $item['search_flag'] = $data['search_flag'];
        $item['where'] = $data['where'];
        $item['credits'] = $cdtMgtModel->get_info_detailed_where_arr($where_data);
        $item['cdt_num'] = $cdtMgtModel->get_info_detailed_num_arr($where_data);
        $item['role'] = $this->_role;
        return $item;
    }

    public function search_credit_need($data = ''){
        $data['where']['cogizance_state'] = '1';
        switch($this->_role){
            case 'normal':
                $data['where']['submit_id']=$this->_id;
                break;
            case 'svip':
                break;
            default:
                $this->login($data);
                exit();
        }
        $adminView = new AdminView();
        $item = $this->search_credit($data);
        $adminView->list_credit_need($item);
    }

    public function search_credit_veto($data = ''){
        $data['where']['cogizance_state'] = '-1';
        switch($this->_role){
            case 'normal':
                $data['where']['submit_id']=$this->_id;
                break;
            case 'svip':
                break;
            default:
                $this->login($data);
                exit();
        }
        $adminView = new AdminView();
        $item = $this->search_credit($data);
        $adminView->list_credit_veto($item);
    }

    public function search_credit_adopt($data = ''){
        $data['where']['cogizance_state'] = '2';
        switch($this->_role){
            case 'normal':
                $data['where']['submit_id']=$this->_id;
                break;
            case 'svip':
                break;
            default:
                $this->login($data);
                exit();
        }
        $adminView = new AdminView();
        $item = $this->search_credit($data);
        $adminView->list_credit_adopt($item);
    }

    public function change_credits_batch($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if (!$this->validate_permission('p_student')) {
            $adminView->access_denied();
        }

        if(!isset($data['check_data'])){
            $adminView->no_select_student($data);
            return;
        }

        $cdtMgtModel = new CreditManageModel();
        $where_data = ['id' => $data['check_data'], 'cogizance_state' => ['0', '1']];
        $item['credits'] = $cdtMgtModel->get_info_where($where_data);
        $item['activity_id'] = $data['activity_id'];
        $adminView->change_credits_batch_page($item);
    }

    public function change_credits_batch_exec($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_student')){
            $adminView->access_denied();
        }

        $cdtMgtModel = new CreditManageModel();
        $whereArr = [];
        foreach($data['cdtIds'] as $id){
            $whereArr[] = "id='$id'";
        }
        $where = '('.implode(" or ", $whereArr).') and activity_id='."'$data[activity_id]'";
        $update_data = ['cogizance_credit' => $data['cogizance_credit']];
        $item['result'] = $cdtMgtModel->update_where($update_data, $where);
        $item['activity_id'] = $data['activity_id'];
        $adminView->change_credits_batch($item);
    }

    public function change_add_credits_batch($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if (!$this->validate_permission('p_student')) {
            $adminView->access_denied();
        }

        if(!isset($data['check_data'])){
            $adminView->no_select_student($data);
            return;
        }

        $cdtMgtModel = new CreditManageModel();
        $where_data = ['id' => $data['check_data'], 'cogizance_state' => ['0', '1']];
        $item['credits'] = $cdtMgtModel->get_info_where($where_data);
        $item['activity_id'] = $data['activity_id'];
        $adminView->change_add_credits_batch_page($item);
    }

    public function change_add_credits_batch_exec($data = ''){
        $adminView = new AdminView();
        $this->validate_jump($data, '?c=Admin&a=login');
        if(!$this->validate_permission('p_student')){
            $adminView->access_denied();
        }

        $cdtMgtModel = new CreditManageModel();
        $whereArr = [];
        foreach($data['cdtIds'] as $id){
            $whereArr[] = "id='$id'";
        }
        $where = '('.implode(" or ", $whereArr).') and activity_id='."'$data[activity_id]'";
        $update_data = ['cogizance_credit' => "cogizance_credit + $data[cogizance_credit]"];
        $item['result'] = $cdtMgtModel->change_add_credit($update_data, $where);
        $item['activity_id'] = $data['activity_id'];
        $adminView->change_add_credits_batch($item);
    }
}