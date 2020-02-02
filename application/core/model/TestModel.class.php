<?php
namespace App\Core\Model;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Core\Model;

class TestModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function __destruct(){
        
    }

    public function test(){
        $data = $this->_db->query_arr("SELECT * FROM tb3 LIMIT 10");
        return $data;
    }

    public function get_user_info_by_name($username = ''){
        $data = $this->_db->query_arr("SELECT * FROM user2 WHERE username = '$username' LIMIT 1");
        return $data[0];
    }

    public function test_select(){
        $field = array('*');
        return $this->_db->select('tb3', $field, '', 10);
    }

    public function test_insert(){
        $data = array(
            "username" => "test"
        );
        return $this->_db->insert('tb3', $data);
    }

    public function test_delete(){
        return $this->_db->delete('tb3', 'id=8');
    }

    public function test_update(){
        $data = array(
            "username" => "test9999"
        );
        return $this->_db->update('tb3', $data, 'id=9');
    }
}