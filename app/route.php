<?php

use think\Route;

// 全局变量规则
Route::pattern([
    'id' => '\d+',
]);

Route::group('admin', static function () {
    // 用户管理
    Route::get('rbac/user', 'admin/rbac.user/index');                // 列表
    Route::get('rbac/user/:id', 'admin/rbac.user/read');             // 详情
    Route::post('rbac/user', 'admin/rbac.user/save');                // 创建
    Route::put('rbac/user/:id', 'admin/rbac.user/update');           // 修改
    Route::delete('rbac/user/:id', 'admin/rbac.user/delete');        // 删除
    Route::put('rbac/user/:id/enable', 'admin/rbac.user/enable');    // 启用
    Route::put('rbac/user/:id/disable', 'admin/rbac.user/disable');  // 禁用

    Route::miss('admin/error/miss');
});


return [
];
