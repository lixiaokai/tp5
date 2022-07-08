<?php

namespace app\common\exception;

use think\Exception;

/**
 * 业务 - 异常类.
 */
class BizException extends Exception
{
    protected $message = '授权失败';

    protected $code = 400;
}
