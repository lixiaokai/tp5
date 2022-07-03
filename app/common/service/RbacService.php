<?php

namespace app\common\service;

use think\Request;

/**
 * RBAC 鉴权管理 - 服务类.
 */
class RbacService
{
    /**
     * 权限检查.
     */
    public function check()
    {

    }

    public function getPermissionPath(Request $request)
    {
        $module = $request->module();
        $controller = $request->controller();
        $action = $request->action();


    }

}

