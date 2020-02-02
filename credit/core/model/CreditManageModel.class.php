<?php
namespace App\Core\Model;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Core\DataModel;

class CreditManageModel extends DataModel{
    private $_table = 'credit';

    public function __construct(){
        parent::__construct($this->_table);
    }

    public function __destruct(){
        
    }

    public function get_all_info_detailed(){
        $table = $this->_table . '_detailed';
        return $this->_db->select($table, array('*'), '', '', 'id');
    }

    public function get_info_detailed_where($where, $limit = ''){
        $table = $this->_table . '_detailed';
        return $this->_db->select($table, array('*'), $where, $limit, 'id');
    }

    public function get_info_detailed_where_arr($whereArr, $limit = ''){
        $where_arr = array();
        foreach($whereArr as $k => $v){
            if(isset($v) && $v != ''){
                if(!is_array($v)) {
                    $where_arr[] = "$k='$v'";
                }else{
                    $v_arr = [];
                    foreach($v as $value){
                        if(isset($value) && $value != ''){
                            $v_arr[] = "$k='$value'";
                        }
                    }
                    $where_arr[] = '('.implode(' or ', $v_arr).')';
                }
            }
        }
        $where = implode(' and ', $where_arr);
        return $this->get_info_detailed_where($where, $limit);
    }

    public function get_info_detailed_num($where = ''){
        $table = $this->_table . '_detailed';
        $data = $this->_db->select($table, array('COUNT(*)'), $where, '', 'id');
        return $data[0]['COUNT(*)'];
    }

    public function get_info_detailed_num_arr($whereArr){
        $where_arr = array();
        foreach($whereArr as $k => $v){
            if(isset($v) && $v != '')
                $where_arr[] = "$k='$v'";
        }
        $where = implode(' and ', $where_arr);
        return $this->get_info_detailed_num($where);
    }

    public function veto_credit($id, $cogizant_id){
        $dt = new \DateTime();
        $dataArr = ["cogizance_state"=>'-1',
                    "cogizance_time"=>$dt->format('Y-m-d H:i:s'),
                    "cogizant_id"=>$cogizant_id];
        return $this->_db->update($this->_table, $dataArr, "id='$id'");
    }

    public function affirm_credit($id, $cogizant_id){
        $dt = new \DateTime();
        $dataArr = ["cogizance_state"=>'1',
                    "cogizance_time"=>$dt->format('Y-m-d H:i:s'),
                    "cogizant_id"=>$cogizant_id];
        return $this->_db->update($this->_table, $dataArr, "id='$id'");
    }

    public function affirm_credit_svip($id, $cogizant_id){
        $dt = new \DateTime();
        $dataArr = ["cogizance_state"=>'2',
                    "cogizance_time"=>$dt->format('Y-m-d H:i:s'),
                    "cogizant_id"=>$cogizant_id];
        return $this->_db->update($this->_table, $dataArr, "id='$id'");
    }

    public function change_add_credit($data, $where){
        if(!is_array($data) || $data == ''){
            return false;
        }
        return $this->update_where($data, $where, 0);
    }
}