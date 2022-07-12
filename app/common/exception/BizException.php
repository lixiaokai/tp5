<?php

namespace app\common\exception;

use think\Exception;

/**
 * 业务 - 异常类.
 */
class BizException extends Exception
{
    protected $message = '业务异常';

    protected $code = 400;
}
