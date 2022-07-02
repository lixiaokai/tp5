<?php

namespace app\common\model;

use think\model\Pivot;

/**
 * 角色和权限关联表 - 模型.
 *
 * @property int $id 自增 ID
 * @property int $role_id 角色 ID
 * @property int $permission_id 权限 ID
 * @property string $created_at 创建时间
 */
class RolePermission extends Pivot
{
    /**
     * @var string 完整表名
     */
    protected $table = 'role_permission';

    protected $createTime = 'create_at';
    protected $updateTime = false;

    protected $autoWriteTimestamp = 'datetime';
}
