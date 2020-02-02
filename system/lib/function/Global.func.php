<?php

// 全局函数库文件

function find_spath($lpath){
    if( ($offset = strpos($lpath, BASE_PATH)) === false ){
        return false;
    }

    return substr($lpath, $offset + strlen(BASE_PATH));
}

function array_to_string(array $data){
    $str = '';
    foreach($data as $k=>$v){
        $str .= $k.'='.$v.',';
    }
    return $str;
}