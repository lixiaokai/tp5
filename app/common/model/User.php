<?php

namespace app\common\model;

use think\model\Collection;
use think\model\relation\BelongsToMany;

/**
 * 用户信息 - 模型.
 *
 * @property int $id 用户 ID
 * @property string $nickname 昵称
 * @property string $phone 手机
 * @property string $password 密码
 * @property string $salt 盐值
 * @property string $status 状态 ( enable-启用 disable-禁用 )
 * @property string $created_at 创建时间
 * @property string $updated_at 修改时间
 *
 * @property-read Collection|Role[] $roles 角色信息
 * @property-read array $permissionRoutes 权限路由
 */
class User extends BaseModel
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
    protected $table = 'user';

    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';

    protected $autoWriteTimestamp = 'datetime';

    protected $type = [
        'created_at' =>  'datetime',
        'updated_at' =>  'datetime',
    ];

    protected $hidden = ['password', 'salt'];

    public function getPermissionRoutesAttr(): array
    {
        /* @var Role $role */

        $routes = [];
        foreach ($this->roles->load('permissions') as $role) {
            $routes = array_unique(array_merge($routes, $role->permissions->column('route')));
        }

        return $routes;
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, UserRole::class);
    }
}
