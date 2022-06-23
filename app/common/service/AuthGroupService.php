<?php

namespace app\common\service;

use app\admin\model\AuthGroup;
use app\common\exception\BizException;
use think\db\Query;
use think\exception\DbException;
use think\Paginator;

class AuthGroupService
{
    /**
     * 用户组 - 列表.
     *
     * @throws DbException
     */
    public function search(array $search = []): Paginator
    {
        return (new AuthGroup)
            ->where(static function (Query $query) use ($search) {
                ! empty($search['name']) && $query->where('name', 'like', '%' . $search['name'] . '%');
        })
            ->order('id', 'desc')
            ->paginate();
    }

    /**
     * 用户组 - 详情.
     *
     * @throws DbException
     */
    public function detail(int $id): AuthGroup
    {
        return AuthGroup::get($id);
    }

    /**
     * 用户组 - 创建.
     */
    public function create(array $data): AuthGroup
    {
        return AuthGroup::create($data, true);
    }

    /**
     * 用户组 - 更新.
     *
     * @throws BizException
     */
    public function update(AuthGroup $authGroup, array $data): AuthGroup
    {
        if ($authGroup->save($data) === false) {
            throw new BizException('用户组更新失败');
        }

        return $authGroup;
    }

    /**
     * 用户组 - 删除.
     */
    public function delete(AuthGroup $authGroup): bool
    {
        return true;
    }

    /**
     * 用户组 - 启用.
     */
    public function enable(AuthGroup $authGroup): AuthGroup
    {
        return $authGroup;
    }

    /**
     * 用户组 - 禁用.
     */
    public function disable(AuthGroup $authGroup): AuthGroup
    {
        return $authGroup;
    }
}
