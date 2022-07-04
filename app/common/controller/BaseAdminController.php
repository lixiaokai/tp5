<?php

namespace app\common\controller;

use app\common\model\User;
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
    }

    /**
     * 获取 - 用户 id.
     */
    protected function uid(): int
    {
        return 1;
    }
}
