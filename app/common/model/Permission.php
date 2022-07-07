<?php

namespace app\common\model;

use think\model\Collection;
use think\model\relation\BelongsToMany;

/**
 * 权限信息 - 模型.
 *
 * @property int $id 角色 ID
 * @property string $name 名称
 * @property string $route 唯一权限路由标识
 * @property string $created_at 创建时间
 * @property string $updated_at 修改时间
 *
 * @property-read Collection|Role[] $roles 角色信息
 */
class Permission extends BaseModel
{
    /**
     * @var string 完整表名
     */
    protected $table = 'permission';

    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';

    protected $autoWriteTimestamp = 'datetime';

    protected $type = [
        'created_at' =>  'datetime',
        'updated_at' =>  'datetime',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, RolePermission::class);
    }
}
