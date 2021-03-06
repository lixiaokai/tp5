<?php

namespace app\common\service;

use app\common\exception\DataNotFoundException;
use app\common\exception\DataSaveErrorException;
use app\common\model\User;
use app\common\repository\UserRepository;
use think\exception\DbException;
use think\Paginator;

/**
 * 用户管理 - 服务类.
 */
class UserService
{
    /**
     * @var UserRepository
     */
    protected $repo;

    public function __construct()
    {
        $this->repo = new UserRepository();
    }

    /**
     * 用户 - 列表.
     *
     * @throws DbException
     */
    public function search(array $search = []): Paginator
    {
        // 查询 [ 昵称 ]
        if (! empty($search['nickname'])) {
            $this->repo->query->where('nickname', 'like', '%' . $search['nickname'] . '%');
        }

        return $this->repo->query->order('id', 'desc')->paginate();
    }

    /**
     * 用户 - 详情.
     *
     * @throws DataNotFoundException
     */
    public function get(int $id): User
    {
        try {
            return $this->repo->getById($id);
        } catch (DataNotFoundException $e) {
            throw new DataNotFoundException('用户信息 不存在');
        }
    }

    /**
     * 用户 - 创建.
     *
     * @throws DataSaveErrorException
     */
    public function create(array $data): User
    {
        return $this->repo->create($data);
    }

    /**
     * 用户 - 更新.
     *
     * @throws DataSaveErrorException
     */
    public function update(User $model, array $data): User
    {
        return $this->repo->update($model, $data);
    }

    /**
     * 用户 - 删除.
     */
    public function delete(User $model): void
    {
        $this->repo->delete($model);
    }

    /**
     * 用户 - 启用.
     */
    public function enable(User $model): User
    {
        return $this->repo->enable($model);
    }

    /**
     * 用户 - 禁用.
     */
    public function disable(User $model): User
    {
        return $this->repo->disable($model);
    }
}

