<?php

namespace app\admin\validate;

use app\common\validate\BaseValidate;

class AuthGroupValidate extends BaseValidate
{
    protected $rule = [
        'status' => ['require', 'integer'],
        'title' => ['require'],
        'rules' => ['require'],
    ];

    protected $field = [
        'status' => '状态',
        'title' => '名称',
        'rules' => '规则',
    ];
}
