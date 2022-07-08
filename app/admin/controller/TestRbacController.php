<?php

namespace app\admin\controller;

use app\common\controller\BaseAdminController;
use app\common\exception\BizException;
use app\common\exception\UnauthorizedException;
use app\common\service\AuthService;
use app\common\service\JWTService;
use think\Config;
use think\exception\DbException;
use think\Request;
use think\Response;

/**
 * 测试控制器 - 基类.
 */
class TestRbacController extends BaseAdminController
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        if (! Config::get('app_debug')) {
            abort(404, '资源不存在');
        }
    }

    public function index(): Response
    {
        $this->testLogin();
        return response('index');
    }

    public function type(): Response
    {
        return response('');
    }

    /**
     * 测试 - 用户授权.
     *
     * @throws BizException|DbException|UnauthorizedException
     */
    protected function testLogin(): void
    {
        $identity = '13800138000';
        $password = '123456';

        $auth = AuthService::instance();
        $user = $auth->login($identity, $password);
        $jwt = JWTService::encode($user);
        $jwtObj = JWTService::decode($jwt);

        var_dump([
            'jwt' => $jwt,
            'jwtObj' => $jwtObj,
            'iat' => date('Y-m-d H:i:s', $jwtObj->iat),
            'exp' => date('Y-m-d H:i:s', $jwtObj->exp),
            'now' => date('Y-m-d H:i:s'),
        ]);
    }
}
