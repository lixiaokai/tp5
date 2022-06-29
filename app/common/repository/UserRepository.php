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
}
