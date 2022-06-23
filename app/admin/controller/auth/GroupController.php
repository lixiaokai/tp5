<?php

namespace app\admin\controller\auth;

use app\admin\validate\AuthGroupValidate;
use app\common\controller\BaseAdminController;
use app\common\exception\BizException;
use app\common\service\AuthGroupService;
use think\exception\DbException;
use think\Request;
use think\Response;

/**
 * 用户组 - 控制器.
 */
class GroupController extends BaseAdminController
{
    /**
     * @var AuthGroupService $service
     */
    protected $service;

    protected function _initialize(): void
    {
        $this->service = new AuthGroupService();
    }

    /**
     * 用户组 - 列表.
     *
     * @throws DbException
     */
    public function index(): Response
    {
        $search = $this->request->param();
        $res = [
            'code' => 200,
            'data' => $this->service->search($search),
        ];

        return json($res);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 用户组 - 创建.
     */
    public function save(AuthGroupValidate $validate): Response
    {
        $authGroup = $this->service->create($validate->checked());

        return json([
            'code' => 200,
            'data' => ['id' => $authGroup->id],
        ]);
    }

    /**
     * 用户组 - 详情.
     */
    public function read($id): Response
    {
        $authGroup = $this->service->detail($id);

        return json([
            'code' => 200,
            'data' => $authGroup,
        ]);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 用户组 - 更新.
     *
     * @throws BizException|DbException
     */
    public function update(AuthGroupValidate $validate, int $id)
    {
        $authGroup = $this->service->detail($id);
        $data = $validate->checked();
        $this->service->update($authGroup, $data);

        return json([
            'code' => 200,
            'data' => $authGroup,
        ]);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
