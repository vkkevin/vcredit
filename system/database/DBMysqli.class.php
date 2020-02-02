<?php
namespace System\Database;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

use System\Core\DB;

class DBMysqli extends DB{
    public function __construct(array $config = array()){
        parent::__construct($config);
    }

    public function connect(array $config = array()){
        $this->_config = empty($config)?$this->_config:$config;
        $this->_conn = mysqli_connect(
            $this->_config['hostname'],
            $this->_config['username'],
            $this->_config['password'],
            $this->_config['database'],
            $this->_config['port']);
        
        if($this->_conn == null){
            debug_exit(__FILE__, __LINE__, 'Connection False!');
            return false;
        }

        $this->_conn->query('SET NAMES '.$this->_config['char_set']);
        return true;
    }

    public function fetch_array_all($res){
        if($res == false || $res == ''){
            debug(__FILE__, __LINE__, 'Error: $res is error!');
        }
        $num = mysqli_num_rows($res);

        $data = array();
        for($i = 0; $i < $num; $i++){
            $row = mysqli_fetch_assoc($res);
            $data[$i] = $row;
        }
        return $data;
    }

    public function query($sql){
        if(!is_object($this->_conn)){
            $this->connect();
        }

        $res = mysqli_query($this->_conn, $sql);
        if($res == false){
            debug(__FILE__, __LINE__, '查询失败！');
            return false;
        }
        return $res;
    }

    public function query_arr($sql){
        if(!is_object($this->_conn)){
            $this->connect();
        }

        $res = mysqli_query($this->_conn, $sql);
        if($res == false){
            debug(__FILE__, __LINE__, '查询失败！');
            return false;
        }
        $data = $this->fetch_array_all($res);
        mysqli_free_result($res);
        return $data;
    }

    public function free_result($res){
        if($res != null){
            mysqli_free_result($res);
        }
    }

    public function select($table, $field, $where = '', $limit = '', $order = '', $group = ''){
        if(!is_object($this->_conn)){
            $this->connect();
        }
        if($table == ''){
            return false;
        }
        $table = $this->_config['tablepre'] . $table;
        $where = $where == ''? '': ' WHERE '.$where;
        $limit = $limit == ''? '': ' LIMIT '.$limit;
        $order = $order == ''? '': ' ORDER BY '.$order;
        $group = $group == ''? '': ' GROUP BY '.$group;

        // implode 将数组转化为字符串
        array_walk($field, array($this, 'add_special_char'));
        $fieldStr = implode(',', $field);
        /* 此处可添加检查字符串的方法 */
        // explode 将字符串打散成数组
        // $field = explode(',', $fieldStr);
        
        $sql = 'SELECT '.$fieldStr.' FROM `'.$table.'`'.$where.$group.$order.$limit;
        $data = $this->query_arr($sql);
        return $data;
    }

    public function insert($table, $data){
        if(!is_object($this->_conn)){
            $this->connect();
        }
        if(!is_array($data) || $table == '' || count($data) == 0){
            return false;
        }

        $table = $this->_config['tablepre'] . $table;
        $fieldArray = array_keys($data);
        $valueArray = array_values($data);
        array_walk($fieldArray, array($this, 'add_special_char'));
		array_walk($valueArray, array($this, 'escape_string'));

        $field = implode(',', $fieldArray);
        $value = implode(',', $valueArray);

        $sql = 'INSERT INTO `'.$table.'`('.$field.') VALUES('.$value.')';
        $return = $this->query($sql);
        return $return;
    }

    public function update($table, $data, $where = '', $quotation = 1){
        if(!is_object($this->_conn)){
            $this->connect();
        }
        if(!is_array($data) || count($data) == 0 || 
            $table == '' || $where == '') {
			return false;
        }
        
        $table = $this->_config['tablepre'] . $table;
        $fieldArray = array();
        foreach($data as $k=>$v){
            $fieldArray[] = $this->add_special_char($k).'='.$this->escape_string($v, '', $quotation);
        }
        $where = ' WHERE '.$where;
        $field = implode(',', $fieldArray);
        $sql = 'UPDATE `'.$table.'` SET '.$field.$where;
        print_r($sql);
        $return = $this->query($sql);
        return $return;
    }

    public function delete($table, $where){
        if(!is_object($this->_conn)){
            $this->connect();
        }
        if($table == '' || $where == '') {
			return false;
        }
        
        $table = $this->_config['tablepre'] . $table;
		$where = ' WHERE '.$where;
        $sql = 'DELETE FROM `'.$table.'`'.$where;
		return $this->query($sql);
    }

    public function insert_id(){
        if(!is_object($this->_conn)){
            $this->connect();
        }
        return mysqli_insert_id($this->_conn);
    }

    public function close(){
        mysqli_close($this->_conn);
        $this->_conn = null;
    }

    /**
	 * 对字段两边加反引号，以保证数据库安全
	 * @param string $value 字段
     * @return string $value
	 */
	public function add_special_char(&$value) {
        if('*' == $value || false !== strpos($value, '(') || 
            false !== strpos($value, '.') || false !== strpos ( $value, '`')) {
			//不处理包含* 或者 使用了sql方法。
		} else {
			$value = '`'.trim($value).'`';
		}
		if (preg_match("/\b(select|insert|update|delete)\b/i", $value)) {
			$value = preg_replace("/\b(select|insert|update|delete)\b/i", '', $value);
		}
		return $value;
	}
	
	/**
	 * 对字段值两边加引号，以保证数据库安全
	 * @param string $value 字段
	 * @param string $key 字段key
	 * @param integer $quotation
     * @return string $value
	 */
	public function escape_string(&$value, $key='', $quotation = 1) {
		if ($quotation) {
			$q = '\'';
		} else {
			$q = '';
		}
		$value = $q.$value.$q;
		return $value;
	}


}