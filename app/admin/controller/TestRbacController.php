<?php

namespace app\admin\controller;

use app\common\controller\BaseAdminController;
use think\Config;
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
        return response();
    }
}
