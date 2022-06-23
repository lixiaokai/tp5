<?php

namespace app\admin\validate;

use app\common\validate\BaseValidate;

class AuthGroupValidate extends BaseValidate
{
    protected $rule = [
        'status' => ['require', 'integer'],
        'name' => ['require'],
        'rules' => ['require'],
    ];

    protected $field = [
        'status' => '状态',
        'name' => '名称',
        'rules' => '规则',
    ];
}
