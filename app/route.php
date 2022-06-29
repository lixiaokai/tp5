<?php

use think\Route;

Route::group('admin', static function () {
    // 用户组
    Route::get('auth/group/:id','admin/auth.group/read');   // 详情
    Route::put('auth/group/:id','admin/auth.group/update'); // 修改
    Route::get('auth/group','admin/auth.group/index');      // 列表
    Route::post('auth/group','admin/auth.group/save');      // 创建

    // 用户管理
    Route::get('rbac/user','admin/rbac.user/index');      // 列表
    Route::get('rbac/user/:id','admin/rbac.user/read');   // 详情
    Route::post('rbac/user','admin/rbac.user/save');      // 创建
    Route::put('rbac/user/:id','admin/rbac.user/update'); // 修改
});

// Route::miss('blog/miss');
