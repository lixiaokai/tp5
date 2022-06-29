<?php

namespace app\common\exception;

use Exception;
use think\App;
use think\exception\HttpException;
use think\exception\ValidateException;
use think\Response;

/**
 * 自定义异常处理.
 */
class Handle extends \think\exception\Handle
{
    /**
     * @var int 默认状态码
     */
    protected $code = 500;

    /**
     * @var string 默认异常消息
     */
    protected $message;

    public function render(Exception $e): Response
    {
        switch ($e) {
            // Http 异常
            case $e instanceof HttpException:
                $this->code = $e->getStatusCode();
                $this->message = $e->getMessage();
                break;

            // 验证器异常
            case $e instanceof ValidateException:
                $this->code = 422;
                $this->message = $e->getError();
                break;

            // 业务异常
            case $e instanceof BizException;
                $this->code = $e->getCode();
                $this->message = $e->getMessage();
                break;
        }

        $data = [
            'code' => $this->code,
            'msg' => $this->message ?: $e->getMessage(),
            'data' => null,
        ];

        // 开启 debug 时附加数据
        // if (App::$debug) {
        //    $data['trace'] = $e->getTrace();
        // }

        return Response::create($data, 'json');
    }
}
