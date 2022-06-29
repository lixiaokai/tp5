<?php

namespace app\common\repository;

use app\common\exception\DataSaveErrorException;
use app\common\exception\DataNotFoundException;
use think\db\Query;
use think\exception\DbException;
use think\Loader;
use think\Model;

/**
 * 仓库基类.
 */
abstract class BaseRepository
{
    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @var Model
     */
    public $model;

    /**
     * @var Query
     */
    public $query;

    public function __construct()
    {
        $this->model = Loader::model($this->modelClass);
        $this->query = $this->model->getQuery();
    }

    /**
     * 获取 1 行数据 - 根据 ID.
     *
     * @throws DataNotFoundException
     */
    public function getById(int $id): Model
    {
        $message = 'table data not Found';

        try {
            $row = $this->model::get($id);
            if (! $row) {
                throw new DataNotFoundException($message);
            }
            return $row;
        } catch (DbException $e) {
            throw new DataNotFoundException($message);
        }
    }

    /**
     * @throws DataSaveErrorException
     */
    public function create(array $data): Model
    {
        try {
            return $this->model::create($data);
        } catch (\Exception $e) {
            throw new DataSaveErrorException();
        }
    }

    /**
     * @throws DataSaveErrorException
     */
    public function update(Model $model, array $data): Model
    {
        if ($model->save($data) === false) {
            throw new DataSaveErrorException();
        }

        return $model;
    }
}
