<?php

namespace app\common\exception;

use Exception;
use think\exception\HttpException;
use think\exception\ValidateException;
use think\Response;

/**
 * 自定义异常处理.
 */
class Handle extends \think\exception\Handle
{
    /**
     * @var int 状态码
     */
    protected $code;

    /**
     * @var int HTTP 状态码
     */
    protected $statusCode;

    /**
     * @var string 异常消息
     */
    protected $message;

    public function render(Exception $e): Response
    {
        $this->message = $e->getMessage();
        $this->statusCode = $this->code = $e->getCode();

        switch ($e) {
            // Http 异常
            case $e instanceof HttpException:
                $this->statusCode = $this->code = $e->getStatusCode();
                break;

            // 验证器异常
            case $e instanceof ValidateException:
                $this->statusCode = $this->code = 422;
                $this->message = $e->getError();
                break;
        }

        $data = [
            'code' => $this->code,
            'msg' => $this->message,
            'data' => null,
        ];

        return parent::render($e);

        // return Response::create($data, 'json', $this->statusCode);
    }
}
