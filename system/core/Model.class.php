<?php
namespace System\Core;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Lib\Core\DBFactory;

abstract class Model{
    protected $_db;

    public function __construct(){
        $this->_db = DBFactory::get_instance();
        $this->_db->connect();
    }

    public function __destruct(){
        $this->_db->close();
        $this->_db = null;
    }

    public function database(){
        return $this->_db;
    }
}

class DataModel extends Model{
    protected $_dataTable;

    public function __construct($dataTable){
        parent::__construct();
        $this->_dataTable = $dataTable;
    }

    public function __destruct(){
        // parent::__destruct();
    }

    public function get_all(){
        return $this->_db->select($this->_dataTable, array('*'), '', '', 'id');
    }
    
    public function get_info_by_id($id){
        $data = $this->_db->select($this->_dataTable, array('*'), 'id='."'$id'", 1, 'id');
        return $data[0];
    }

    public function get_data_by_id($id){
        return $this->get_info_by_id($id);
    }


    public function get_info_by_lim($limit){
        return $this->_db->select($this->_dataTable, array('*'), '', $limit, 'id');
    }

    public function get_data_by_lim($limit){
        return $this->get_info_by_lim($limit);
    }

    public function get_info_by_name($name){
        return $this->_db->select($this->_dataTable, array('*'), 'name='."'$name'", '', 'id');
    }

    public function get_data_by_name($name){
        return $this->get_info_by_name($name);
    }

    public function get_info_where($where_data, $limit = ''){
        if(!is_array($where_data) || $where_data == ''){
            return $this->get_all();
        }
        $where_arr = array();
        foreach($where_data as $k => $v){
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
        return $this->_db->select($this->_dataTable, array('*'), $where, $limit, 'id');
    }

    public function get_data_where($where_data, $limit){
        return $this->get_info_where($where_data, $limit);
    }

    public function get_info_num($where_data = ''){
        if(!is_array($where_data) || $where_data == ''){
            $data = $this->_db->select($this->_dataTable, array('COUNT(*)'));
            return $data[0]['COUNT(*)'];
        }
        $where_arr = array();
        foreach($where_data as $k => $v){
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
        $data = $this->_db->select($this->_dataTable, array('COUNT(*)'), $where);
        return $data[0]['COUNT(*)'];
    }

    public function get_data_num($where_data){
        return $this->get_info_num($where_data);
    }

    public function add_info($data = ''){
        if(!is_array($data) || $data == ''){
            return false;
        }
        return $this->_db->insert($this->_dataTable, $data);
    }

    public function add_data(array $data){
        return $this->add_info($data);
    }

    public function del_info_by_id($id){
        return $this->_db->delete($this->_dataTable, 'id='."'$id'");
    }

    public function del_data_by_id($id){
        return $this->del_info_by_id($id);
    }

    public function del_info_by_name($name){
        return $this->_db->delete($this->_dataTable, 'name='."'$name'");
    }

    public function del_data_by_name($name){
        return $this->del_info_by_name($name);
    }

    public function update($data, $quotation = 1){
        if(!is_array($data) || $data == '' || !isset($data['id'])){
            return false;
        }
        $dataId = $data['id'];
        unset($data['id']);
        return $this->_db->update($this->_dataTable, $data, 'id='."'$dataId'", $quotation);
    }

    public function update_where($data, $where, $quotation = 1){
        if(!is_array($data) || $data == ''){
            return false;
        }
        return $this->_db->update($this->_dataTable, $data, $where, $quotation);
    }
}