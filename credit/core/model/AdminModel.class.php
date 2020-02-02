<?php
namespace App\Core\Model;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Core\Model;

class AdminModel extends Model{
    private $_table = 'admin';
    public function __construct(){
        parent::__construct();
    }

    public function __destruct(){

    }
    
    public function get_info_by_name($name){
        if($name == ''){  // 检查 name
            return false;
        }
        return $this->_db->select($this->_table, array('*'), "name='$name'");
    }

    public function get_info_by_id($id){
        if($id == ''){  // 检查 id
            return false;
        }
        $data = $this->_db->select($this->_table, array('*'), "id='$id'");
        return $data[0];
    }

    public function reset_password($id, $newPassword){
        return $this->_db->update($this->_table, array("password"=>$newPassword), "id='$id'");
    }
}