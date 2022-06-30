<?php

namespace app\common\controller;

use app\common\exception\DataNotFoundException;

/**
 * Miss 控制器 - 基类.
 */
class ErrorController extends BaseController
{
    /**
     * @throws DataNotFoundException
     */
    public function miss(): void
    {
        throw new DataNotFoundException('资源不存在');
    }
}
