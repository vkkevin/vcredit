<?php
namespace App\Core\Model;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Core\DataModel;

class ActivityManageModel extends DataModel{
    private $_table = 'activity';

    public function __construct(){
        parent::__construct($this->_table);
    }

    public function __destruct(){

    }

    public function get_all(){
        $viewTable = $this->_table.'_view';
        return $this->_db->select($viewTable, array('*'), '', '', 'id');
    }
    
    public function get_info_by_id($id){
        $viewTable = $this->_table.'_view';
        $data = $this->_db->select($viewTable, array('*'), 'id='."'$id'", 1, 'id');
        return $data[0];
    }

    public function get_info_by_name($name){
        $viewTable = $this->_table.'_view';
        return $this->_db->select($viewTable, array('*'), 'name='."'$name'", '', 'id');
    }

    public function get_info_by_lim($limit){
        $viewTable = $this->_table.'_view';
        return $this->_db->select($viewTable, array('*'), '', $limit, 'id');
    }

    public function get_info_where($where_data, $limit = ''){
        if(!is_array($where_data) || $where_data == ''){
            return $this->get_all();
        }
        $where_arr = array();
        foreach($where_data as $k => $v){
            if(isset($v) && $v != '')
                $where_arr[] = "$k='$v'";
        }
        $where = implode(' and ', $where_arr);
        $viewTable = $this->_table.'_view';
        return $this->_db->select($viewTable, array('*'), $where, $limit, 'id');
    }

    public function get_type_info(){
        $table = 'activity_type';
        return $this->_db->select($table, array('*'), '', '', 'id');
    }

    public function get_participator_by_actId($id){
        $t1 = $this->_db->tablepre().'activity_participator';
        $t2 = $this->_db->tablepre().'student';
        $sql = "SELECT `$t2`.* FROM `$t1`,`$t2` WHERE activity_id='$id' AND `$t1`.student_id=`$t2`.id";
        $data = $this->_db->query_arr($sql);
        return $data;
    }

    public function get_participator_num_by_2id($actId, $stuId){
        $table = $this->_db->tablepre().'activity_participator';
        $sql = "SELECT COUNT(*) FROM `$table` WHERE activity_id='$actId' AND student_id='$stuId'";
        $data = $this->_db->query_arr($sql);
        return $data[0]['COUNT(*)'];
    }

    public function add_participator(){
        // TODO: 编写添加参与者接口
    }
}