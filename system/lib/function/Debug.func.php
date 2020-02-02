<?php
// 调试库文件

function debug($file, $line, $message, $tag = 'DEBUG'){
    if(($spath = find_spath($file)) !== false){
        $file = $spath;
    }

    \System\Core\Log::debug($file, $line, $message, $tag);

    if(!defined('DEBUG') || DEBUG == false){
        return;
    }

    if(is_array($message)){
        $message = array_to_string($message);
    }

    echo $file.':'.$line.': '.$message."<br/>\n";
}

function debug_exit($file, $line, $message){
    debug($file, $line, $message);
    exit();
}
