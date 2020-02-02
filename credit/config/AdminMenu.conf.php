<?php

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

$config = [
    "normal" => [
        [
            "name" => "活动管理",
            "menu" => [
                [
                    "name" => "添加活动",
                    "url" => "?c=Admin&a=add_activity",
                    "target" => "main"
                ],
                [
                    "name" => "活动列表",
                    "url" => "?c=Admin&a=list_activity",
                    "target" => "main"
                ]
            ]
        ],
        [
            "name" => "学分认定管理",
            "menu" => [
                [
                    "name" => "添加学分认定",
                    "url" => "?c=Admin&a=add_credit_cogizance",
                    "target" => "main"
                ],
                [
                    "name" => "已提交列表",
                    "url" => "?c=Admin&a=list_credit_need",
                    "target" => "main"
                ],
                [
                    "name" => "已认定列表",
                    "url" => "?c=Admin&a=list_credit_adopt",
                    "target" => "main"
                ],
                [
                    "name" => "否决列表",
                    "url" => "?c=Admin&a=list_credit_veto",
                    "target" => "main"
                ]
            ]
        ],
        [
            "name" => "修改密码",
            "url" => "?c=Admin&a=change_password",
            "target" => "main"
        ],
        [
            "name" => "注销登录",
            "url" => "?c=Admin&a=logout",
            "target" => "_parent"
        ]
    ],
    "svip" => [
        [
            "name" => "学生管理",
            "menu" => [
                [
                    "name" => "添加学生",
                    "url" => "?c=Admin&a=add_student",
                    "target" => "main"
                ],
                [
                    "name" => "学生列表",
                    "url" => "?c=Admin&a=list_student",
                    "target" => "main"
                ],
                [
                    "name" => "批量导入",
                    "url" => "?c=Admin&a=blank",
                    "target" => "main"
                ]
            ]
        ],
        [
            "name" => "活动管理",
            "menu" => [
                [
                    "name" => "添加活动",
                    "url" => "?c=Admin&a=add_activity",
                    "target" => "main"
                ],
                [
                    "name" => "活动列表",
                    "url" => "?c=Admin&a=list_activity",
                    "target" => "main"
                ]
            ]
        ],
        [
            "name" => "学分认定管理",
            "menu" => [
                [
                    "name" => "添加学分认定",
                    "url" => "?c=Admin&a=add_credit_cogizance",
                    "target" => "main"
                ],
                [
                    "name" => "未认定列表",
                    "url" => "?c=Admin&a=list_credit_need",
                    "target" => "main"
                ],
                [
                    "name" => "已认定列表",
                    "url" => "?c=Admin&a=list_credit_adopt",
                    "target" => "main"
                ],
                [
                    "name" => "否决列表",
                    "url" => "?c=Admin&a=list_credit_veto",
                    "target" => "main"
                ]
            ]
        ],
        [
            "name" => "系统维护",
            "menu" => [
                [
                    "name" => "版本信息",
                    "url" => "?c=Admin&a=blank",
                    "target" => "main"
                ]
            ]
        ],
        [
            "name" => "修改密码",
            "url" => "?c=Admin&a=change_password",
            "target" => "main"
        ],
        [
            "name" => "注销登录",
            "url" => "?c=Admin&a=logout",
            "target" => "_parent"
        ]
    ]
];

return $config;
