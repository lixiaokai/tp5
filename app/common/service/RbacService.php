<?php

namespace app\common\service;

use app\common\ide\IDERequest;
use app\common\model\User;
use think\exception\DbException;
use think\Loader;
use think\Request;
use traits\think\Instance;

/**
 * RBAC 鉴权管理 - 服务类.
 */
class RbacService
{
    use Instance;

    /**
     * 权限检查.
     *
     * @throws DbException
     */
    public function check(string $route = null, int $uid = null): bool
    {
        // 无需检查的权限路由标识



        return in_array(self::getPermissionRoute($route), self::getPermissionRoutes(), true);
    }

    /**
     * 获取 - 唯一权限路由标识.
     */
    protected static function getPermissionRoute(string $route = null): string
    {
        /**
         * @var Request $request
         */
        $request = Request::instance();

        $module = $request->module(); // 模块名称
        $controller = Loader::parseName($request->controller(), 1, false); // 控制器名称
        $action = $request->action(); // 方法名称

        // 当前路由标识
        $currentRoute = '/' . $module . '/' . $controller . '/' . $action;

        return $route ?? $currentRoute;
    }

    /**
     * 获取 - 唯一权限路由标识.
     *
     * @throws DbException
     */
    protected static function getPermissionRoutes(int $uid = null): array
    {
        if ($uid === null) {
            $request = Request::instance(); /* @var IDERequest $request */
            $user = $request->user;
        } else {
            $user = User::get($uid);
        }

        return $user->permissionRoutes ?? [];
    }
}

