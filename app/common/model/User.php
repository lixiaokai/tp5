<?php

namespace app\common\model;

use think\Model;
use think\model\Collection;
use think\model\relation\BelongsToMany;
use think\model\relation\HasManyThrough;

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
 */
class User extends Model
{
    /**
     * 状态 - 启用.
     */
    const STATUS_ENABLE = 'enable';

    /**
     * 状态 - 禁用.
     */
    const STATUS_DISABLE = 'disable';

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

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, UserRole::class);
    }
}
