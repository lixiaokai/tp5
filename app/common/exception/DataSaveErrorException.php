<?php

namespace app\common\exception;

use think\exception\DbException;

/**
 * 数据 - 异常类.
 */
class DataSaveErrorException extends DbException
{
    protected $message = '数据保存错误';

    protected $code = 500;

    public function __construct($message = '')
    {
        $this->message = $message ?: '';
    }
}
