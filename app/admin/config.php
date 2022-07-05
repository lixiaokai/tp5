<?php

// admin 模块应用配置
return [
    // 自定义异常处理
    'exception_handle' => \app\common\exception\Handle::class,

    // RBAC 权限配置
    'rbac' => [
        'is_enable' => true, // 权限开关
        'no_check' => [
            '/admin/auth/login' // 登录页面
        ], // 无需检查的权限路由
    ],
];
