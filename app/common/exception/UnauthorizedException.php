<?php

namespace app\common\exception;

use think\Exception;

/**
 * 授权 - 异常类.
 */
class UnauthorizedException extends Exception
{
    protected $message = '认证失败';

    protected $code = 401;
}
