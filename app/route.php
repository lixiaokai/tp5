<?php

use think\Route;

Route::group('admin', static function () {
    // 用户管理
    Route::get('rbac/user','admin/rbac.user/index');         // 列表
    Route::get('rbac/user/:id','admin/rbac.user/read');      // 详情
    Route::post('rbac/user','admin/rbac.user/save');         // 创建
    Route::put('rbac/user/:id','admin/rbac.user/update');    // 修改
    Route::delete('rbac/user/:id','admin/rbac.user/delete'); // 删除
});

// Route::miss('blog/miss');
