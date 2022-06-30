<?php

namespace app\admin\controller;

use app\common\controller\BaseAdminController;
use app\common\exception\DataNotFoundException;

/**
 * Miss 控制器 - 基类.
 */
class ErrorController extends BaseAdminController
{
    /**
     * @throws DataNotFoundException
     */
    public function miss(): void
    {
        throw new DataNotFoundException('资源不存在');
    }
}
