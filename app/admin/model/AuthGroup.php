<?php

namespace app\admin\model;

use think\Model;

/**
 * 用户组 - 模型.
 *
 * @property int    $id     自增 ID
 * @property int    $status 状态 ( 0-禁用 1-启用 )
 * @property string $name   名称
 * @property string $rules  规则
 */
class AuthGroup extends Model
{
    protected $table = 'auth_group';

    protected $type = [
        'status' => 'integer',
        'rules' => 'json',
    ];
}
