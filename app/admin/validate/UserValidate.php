<?php

namespace app\admin\validate;

use app\common\validate\BaseValidate;

/**
 * 用户 - 验证类.
 */
class UserValidate extends BaseValidate
{
    protected $rule = [
        'nickname' => ['require', 'min:2', 'max:15', 'unique:user'],
        'phone' => ['require', 'length:11', 'mobile', 'unique:user'],
        'password' => ['require', 'min:6', 'max:20'],
        'password_confirm' => ['require', 'confirm:password'],
        'status' => ['require', 'in:enable,disable'],
    ];

    protected $field = [
        'nickname' => '昵称',
        'phone' => '手机号',
        'password' => '密码',
        'password_confirm' => '确认密码',
        'status' => '状态',
    ];

    protected $scene = [
        'update'  =>  ['nickname', 'status'],
    ];

    protected function mobile(string $value)
    {
        return $this->regex($value, '/^1[3-9]\d{9}$/');
    }
}
