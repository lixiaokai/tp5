<?php

namespace app\common\repository;

use app\common\model\Role;

/**
 * 角色 - 仓库.
 *
 * @method Role getById(int $id)
 * @method Role create(array $data)
 * @method Role update(Role $model, array $data)
 */
class RoleRepository extends BaseRepository
{
    /**
     * @var string 模型类
     */
    protected $modelClass = Role::class;

    /**
     * 角色 - 启用.
     */
    public function enable(Role $model): Role
    {
        $model->status = Role::STATUS_ENABLE;
        $model->save();

        return $model;
    }

    /**
     * 角色 - 禁用.
     */
    public function disable(Role $model): Role
    {
        $model->status = Role::STATUS_DISABLE;
        $model->save();

        return $model;
    }
}
