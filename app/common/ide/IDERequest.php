<?php

namespace app\common\ide;

use app\common\model\User;
use think\Request;

/**
 * 请求类 - IDE 提示.
 *
 * 说明：
 * 由于属性注入 https://www.kancloud.cn/manual/thinkphp5/207503
 * 或方法注入到 Request 类后，ide 不知道有该属性或方法，需要通过手动构建注释来解决.
 */
class IDERequest extends Request
{
    /**
     * @var User
     */
    public $user;
}
