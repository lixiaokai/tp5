<?php

namespace app\common\model;

use think\Model;
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
 */
class Role extends Model
{
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
}
