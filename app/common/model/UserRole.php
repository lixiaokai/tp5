<?php

namespace app\common\model;

use think\model\Pivot;

/**
 * 用户和角色关联表 - 模型.
 *
 * @property int $id 自增 ID
 * @property int $user_id 用户 ID
 * @property int $role_id 角色 ID
 * @property string $created_at 创建时间
 */
class UserRole extends Pivot
{
    protected $table = 'user_role';

    protected $createTime = 'create_at';
    protected $updateTime = false;

    protected $autoWriteTimestamp = 'datetime';
}
