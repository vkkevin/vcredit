<?php
namespace System\Core;

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

abstract class DB{
    protected $_conn;
    protected $_config;

    public function __construct(array $config = array()){
        $this->_conn = null;
        $this->_config = $config;
    }

    public abstract function connect(array $config = array());

    public abstract function query($sql);

    public abstract function query_arr($sql);

    public abstract function free_result($res);

    public abstract function select($table, $field, $where, $limit, $order, $group);

    public abstract function insert($table, $data);

    public abstract function update($table, $data, $where);

    public abstract function delete($table, $where);

    public abstract function close();

    public function __destruct(){
        $this->_conn = null;
    }

    public function tablepre(){
        if(array_key_exists('tablepre', $this->_config))
            return $this->_config['tablepre'];
        return '';
    }

    public function type(){
        if(array_key_exists('type', $this->_config))
            return $this->_config['type'];
        return '';
    }

}

