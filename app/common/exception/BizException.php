<?php

namespace app\common\exception;

class BizException extends BaseException
{
    protected $message = '业务异常';

    protected $code = 200;
}
