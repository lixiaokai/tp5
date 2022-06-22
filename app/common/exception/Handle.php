<?php

namespace app\common\exception;

use Exception;
use think\exception\HttpException;
use think\exception\ValidateException;
use think\Response;

/**
 * 自定义异常处理.
 *
 * Todo: 待完善.
 */
class Handle extends \think\exception\Handle
{
    public function render(Exception $e): Response
    {
        // 参数验证错误
        if ($e instanceof ValidateException) {
            return json(['code' => 422, 'msg'  => $e->getError(), 'data' => []], 422);
        }

        // 请求异常
        if ($e instanceof HttpException && request()->isAjax()) {
            return response($e->getMessage(), $e->getStatusCode());
        }

        // 剩下的交由原系统处理
        return parent::render($e);
    }
}
