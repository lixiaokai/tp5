<?php

namespace app\common\service;

use app\common\exception\DataNotFoundException;
use app\common\exception\DataSaveErrorException;
use app\common\model\Role;
use app\common\repository\RoleRepository;
use think\exception\DbException;
use think\Paginator;

/**
 * 角色管理 - 服务类.
 */
class RoleService
{
    /**
     * @var RoleRepository
     */
    protected $repo;

    public function __construct()
    {
        $this->repo = new RoleRepository();
    }

    /**
     * 角色 - 列表.
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
     * 角色 - 详情.
     *
     * @throws DataNotFoundException
     */
    public function get(int $id): Role
    {
        try {
            return $this->repo->getById($id);
        } catch (DataNotFoundException $e) {
            throw new DataNotFoundException('用户信息 不存在');
        }
    }

    /**
     * 角色 - 创建.
     *
     * @throws DataSaveErrorException
     */
    public function create(array $data): Role
    {
        return $this->repo->create($data);
    }

    /**
     * 角色 - 更新.
     *
     * @throws DataSaveErrorException
     */
    public function update(Role $model, array $data): Role
    {
        return $this->repo->update($model, $data);
    }

    /**
     * 角色 - 删除.
     */
    public function delete(Role $model): void
    {
        $this->repo->delete($model);
    }

    /**
     * 角色 - 启用.
     */
    public function enable(Role $model): Role
    {
        return $this->repo->enable($model);
    }

    /**
     * 角色 - 禁用.
     */
    public function disable(Role $model): Role
    {
        return $this->repo->disable($model);
    }
}

