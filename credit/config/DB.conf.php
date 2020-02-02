<?php

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

$config = [
    'hostname' => 'localhost',
    'port' => 3306,
    'username' => 'vcoder',
    'password' => 'vcoder1259',
    'database' => 'xy_credit_cognizance',
    'tablepre' => 'xy_',
    'type' => 'Mysqli', // database/文件类名
    'char_set' => 'UTF8'
];

return $config;
