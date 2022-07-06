<?php

namespace app\common\ide;

use stdClass;

/**
 * JWT 解码 - IDE 提示.
 */
class IDEJWTPayloadStdClass extends stdClass
{
    /**
     * @var string 签发者
     */
    public $iss = 'auth';
    /**
     * @var string 主题
     */
    public $sub = 'token';

    /**
     * @var int 签名时间
     */
    public $iat;

    /**
     * @var int 过期时间
     */
    public $exp;

    /**
     * @var int 用户 UID
     */
    public $uid;
}
