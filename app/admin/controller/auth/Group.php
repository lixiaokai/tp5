<?php

namespace app\admin\controller\auth;

use app\admin\validate\AuthGroupValidate;
use app\common\controller\BaseAdminController;
use app\common\service\AuthGroupService;
use think\exception\DbException;
use think\Request;
use think\Response;

/**
 * 用户组 - 控制器.
 */
class Group extends BaseAdminController
{
    /**
     * @var AuthGroupService $service
     */
    protected $service;

    public function _initialize(): void
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
        $res = [
            'code' => 200,
            'data' => $this->service->search(),
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
     * 保存新建的资源
     */
    public function save(AuthGroupValidate $validate): Response
    {
        $data = $validate->checked();

        return json([
            'method' => $this->request->isAjax(),
            'data' => $data,
        ]);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
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
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
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
