<?php
namespace App\Core\Model;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Core\DataModel;

class StudentManageModel extends DataModel{
    private $_table = 'student';

    public function __construct(){
        parent::__construct($this->_table);
    }

    public function __destruct(){

    }

    public function get_total_credit_by_id($id){
        $data = $this->_db->select('credit', ["SUM(cogizance_credit) AS total_credit"],
                                "student_id='$id' AND cogizance_state='2'");
        if($data[0]['total_credit'] == null){
            return 0;
        }
        return $data[0]['total_credit'];
    }
}