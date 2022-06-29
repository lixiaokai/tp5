<?php

namespace app\admin\controller\rbac;

use app\admin\validate\UserValidate;
use app\common\controller\BaseAdminController;
use app\common\exception\DataNotFoundException;
use app\common\exception\DataSaveErrorException;
use app\common\service\UserService;
use think\exception\DbException;
use think\Response;

/**
 * 用户管理 - 控制器.
 */
class UserController extends BaseAdminController
{
    /**
     * @var UserService $service
     */
    protected $service;

    protected function _initialize(): void
    {
        $this->service = new UserService();
    }

    /**
     * 用户管理 - 列表.
     *
     * @throws DbException
     */
    public function index(): Response
    {
        $res = $this->service->search($this->request->param());

        return json(['code' => 200, 'data' => $res]);
    }

    /**
     * 用户管理 - 详情.
     *
     * @throws DataNotFoundException
     */
    public function read($id): Response
    {
        $user = $this->service->get($id);

        return json(['code' => 200, 'data' => $user]);
    }

    /**
     * 用户管理 - 创建.
     *
     * @throws DataSaveErrorException
     */
    public function save(UserValidate $validate): Response
    {
        $model = $this->service->create($validate->checked());

        return json(['code' => 200, 'data' => $model]);
    }

    /**
     * 用户管理 - 更新.
     *
     * @throws DataNotFoundException|DataSaveErrorException
     */
    public function update(UserValidate $validate, int $id): Response
    {
        $model = $this->service->get($id);
        $data = $validate->scene('update')->checked();
        $this->service->update($model, $data);

        return json(['code' => 200, 'data' => $model]);
    }

    /**
     * 用户管理 - 删除.
     *
     * @throws DataNotFoundException
     */
    public function delete(int $id): Response
    {
        $model = $this->service->get($id);
        $this->service->delete($model);

        return json(['code' => 200, 'data' => ['id' => $id]]);
    }

    /**
     * 用户管理 - 启用.
     *
     * @throws DataNotFoundException
     */
    public function enable(int $id): Response
    {
        $model = $this->service->get($id);
        $model = $this->service->enable($model);

        return json(['code' => 200, 'data' => $model]);
    }

    /**
     * 用户管理 - 禁用.
     *
     * @throws DataNotFoundException
     */
    public function disable(int $id): Response
    {
        $model = $this->service->get($id);
        $model = $this->service->disable($model);

        return json(['code' => 200, 'data' => $model]);
    }

    /**
     * 显示编辑资源表单页.
     */
    public function edit($id)
    {
        //
    }

    /**
     * 显示创建资源表单页.
     */
    public function create()
    {
        //
    }
}
