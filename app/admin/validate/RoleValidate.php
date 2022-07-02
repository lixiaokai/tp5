<?php

namespace app\admin\validate;

use app\common\validate\BaseValidate;

/**
 * 角色 - 验证类.
 */
class RoleValidate extends BaseValidate
{
    protected $rule = [
        'name' => ['require', 'min:2', 'max:15'],
        'status' => ['require', 'in:enable,disable'],
    ];

    protected $field = [
        'name' => '角色名称',
        'status' => '状态',
    ];
}
