<?php

namespace app\common\model;

use think\model\Collection;
use think\model\relation\BelongsToMany;

/**
 * 角色信息 - 模型.
 *
 * @property int $id 角色 ID
 * @property string $name 名称
 * @property string $status 状态 ( enable-启用 disable-禁用 )
 * @property string $created_at 创建时间
 * @property string $updated_at 修改时间
 *
 * @property-read Collection|User[] $users 用户信息
 * @property-read Collection|Permission[] $permissions 角色信息
 */
class Role extends BaseModel
{
    /**
     * 状态 - 启用.
     */
    public const STATUS_ENABLE = 'enable';

    /**
     * 状态 - 禁用.
     */
    public const STATUS_DISABLE = 'disable';

    /**
     * @var string 完整表名
     */
    protected $table = 'role';

    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';

    protected $autoWriteTimestamp = 'datetime';

    protected $type = [
        'created_at' =>  'datetime',
        'updated_at' =>  'datetime',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, UserRole::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, RolePermission::class);
    }
}
