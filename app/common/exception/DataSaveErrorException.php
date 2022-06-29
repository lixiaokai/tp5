<?php

namespace app\common\exception;

use think\Exception;

/**
 * 数据 - 异常类.
 */
class DataSaveErrorException extends Exception
{
    protected $message = '数据保存错误';

    protected $code = 500;
}
