<?php

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

$config = [
    'normal' => [
        'p_activity' => [
            'add_activity',
            'del_activity'
        ],
        'p_credit' => [
            'add_credit',
            'affirm_credit',
            'veto_credit',
            'del_credit'
        ]
    ],
    'svip' => [
        'p_student' => [
            'add_student',
            'del_student'
        ],
        'p_activity' => [
            'add_activity',
            'del_activity'
        ],
        'p_credit' => [
            'add_credit',
            'affirm_credit',
            'veto_credit',
            'del_credit'
        ]
    ]
];

return $config;