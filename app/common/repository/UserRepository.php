<?php

namespace app\common\repository;

use app\common\model\User;

/**
 * 用户 - 仓库.
 *
 * @method User getById(int $id)
 * @method User create(array $data)
 * @method User update(User $model, array $data)
 */
class UserRepository extends BaseRepository
{
    /**
     * @var string 模型类
     */
    protected $modelClass = User::class;

    /**
     * 用户 - 启用.
     */
    public function enable(User $model): User
    {
        $model->status = User::STATUS_ENABLE;
        $model->save();

        return $model;
    }

    /**
     * 用户 - 禁用.
     */
    public function disable(User $model): User
    {
        $model->status = User::STATUS_DISABLE;
        $model->save();

        return $model;
    }
}
