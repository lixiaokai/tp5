<?php

namespace app\common\model;

use think\model\Pivot;

/**
 * 用户和角色关联表 - 模型.
 */
class UserRole extends Pivot
{
    protected $table = 'user_role';

    protected $createTime = 'create_at';
    protected $updateTime = false;

    protected $autoWriteTimestamp = 'datetime';
}
