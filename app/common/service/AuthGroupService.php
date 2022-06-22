<?php

namespace app\common\service;

use app\admin\model\AuthGroupModel;
use think\db\Query;
use think\exception\DbException;
use think\Paginator;

class AuthGroupService
{
    /**
     * @throws DbException
     */
    public function search(): Paginator
    {
        $title = input('get.title');

        return (new AuthGroupModel)
            ->where(static function (Query $query) use ($title) {
            $title && $query->where('title', 'like', '%' . $title . '%');
        })
            ->order('id', 'desc')
            ->paginate();
    }
}
