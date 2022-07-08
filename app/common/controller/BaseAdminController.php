<?php

namespace app\common\controller;

use app\common\exception\UnauthorizedException;
use app\common\ide\IDERequest;
use app\common\model\User;
use app\common\service\JWTService;
use app\common\service\RbacService;
use think\exception\DbException;

/**
 * admin 控制器 - 基类.
 */
class BaseAdminController extends BaseController
{
    /**
     * @var IDERequest Request 注释类
     */
    protected $request;

    /**
     * @throws DbException|UnauthorizedException
     */
    protected function _initialize(): void
    {
        parent::_initialize();

        // 属性注入
        $this->request->bind('user', User::get($this->uid()));

        // 权限控制
        $rbac = RbacService::instance();
        if (! $rbac->check()) {
            $this->error('抱歉，您没有权限操作');
        }
    }

    /**
     * 获取 - 用户 id.
     *
     * @throws UnauthorizedException
     */
    protected function uid(): int
    {
        $token = JWTService::getToken($this->request);
        return JWTService::decode($token)->uid;
    }
}
