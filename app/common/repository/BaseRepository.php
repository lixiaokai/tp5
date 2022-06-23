<?php

namespace app\common\repository;

use InvalidArgumentException;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\db\Query;
use think\exception\DbException;
use think\Model;

abstract class BaseRepository
{
    /**
     * @var string
     */
    protected $model;

    /**
     * @var Query
     */
    protected $query;

    public function __construct()
    {
        /**
         * @var Model $model
         */
        $model = (new $this->model);
        if (! $model instanceof Model) {
            throw new InvalidArgumentException('property not exists:' . __CLASS__ . ' -> $model');
        }

        $this->query = $model->getQuery();
    }

    /**
     * @throws DbException|DataNotFoundException|ModelNotFoundException
     */
    public function getById(int $id)
    {
        return $this->query->findOrFail($id);
    }
}
