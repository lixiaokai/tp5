<?php

namespace app\common\service;

use app\common\ide\IDERequest;
use app\common\model\User;
use think\Config;
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
     * @var array 配置信息
     */
    protected $config = [
        'is_enable' => true, // 权限开关
        'no_check' => [],    // 无需检查的权限路由
    ];

    public function __construct()
    {
        $this->config = array_merge($this->config, Config::get('rbac') ?? []);
    }

    /**
     * 权限检查.
     *
     * @throws DbException
     */
    public function check(string $route = null, int $uid = null): bool
    {
        // 如果没有开启验证，直接返回 true
        if (! $this->config['is_enable']) {
            return true;
        }

        // 如果无需权限检查，直接返回 true
        $route = self::getPermissionRoute($route);
        if ($this->noCheck($route)) {
            return true;
        }

        // 是否有权限：分别检查根目录、模块、控制器、方法是有存在于权限中
        $permissionRoutes = self::getPermissionRoutes();
        foreach (self::getRoutePath($route) as $path) {
            if (in_array($path, $permissionRoutes, true)) {
                return true;
            }
        }

        return false;
    }

    /**
     * 无需权限检查.
     */
    protected function noCheck(string $route): bool
    {
        return in_array($route, $this->config['no_check'], true);
    }

    /**
     * 获取 - 唯一权限路由标识.
     *
     * @throws DbException
     */
    protected static function getPermissionRoutes(int $uid = null): array
    {
        if ($uid === null) {
            /* @var IDERequest $request */
            $request = Request::instance();
            $user = $request->user;
        } else {
            $user = User::get($uid);
        }

        // 注意：这里不能用这个返回，否则会触发 2 次模型的获取器方法
        // return $user->permissionRoutes ?? [];

        return $user === null ? [] : $user->permissionRoutes;
    }

    /**
     * 获取 - 权限路由标识.
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
     * 获取 - 权限路由标识拆分后数组.
     *
     * 例如 ( 包含根目录、模块、控制器、方法 )：
     * 1. /
     * 2. /admin
     * 3. /admin/user
     * 4. /admin/user/index
     */
    protected static function getRoutePath(string $route): array
    {
        $routes = [];
        $item = explode('/', $route);
        $item = array_map(static function ($val) { return '/'. $val; }, $item);
        foreach ($item as $key => $val) {
            $routes[] = $key < 2 ? $val : $routes[$key - 1] . $val;
        }

        return $routes;
    }
}

