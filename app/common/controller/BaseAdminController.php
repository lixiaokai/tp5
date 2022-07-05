<?php

namespace app\common\controller;

use app\common\model\User;
use app\common\service\RbacService;
use think\exception\DbException;
use think\Request;

/**
 * admin 控制器 - 基类.
 */
class BaseAdminController extends BaseController
{
    /**
     * @throws DbException
     */
    protected function _initialize(): void
    {
        // 属性注入
        Request::instance()->bind('user', User::get($this->uid()));

        // 权限控制
        $rbac = RbacService::instance();
        if (! $rbac->check()) {
            $this->error('抱歉，您没有权限操作');
        }
    }

    /**
     * 获取 - 用户 id.
     */
    protected function uid(): int
    {
        return 1;
    }
}
