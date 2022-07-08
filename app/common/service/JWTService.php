<?php

namespace app\common\service;

use app\common\exception\BizException;
use app\common\exception\UnauthorizedException;
use app\common\ide\IDEJWTPayloadStdClass;
use app\common\model\User;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;
use think\Config;
use think\Log;

class JWTService
{
    /**
     * 获取 - token.
     */
    public static function token(string $authorization): string
    {
        // Todo: 暂时隐藏起来
        // return substr_count($authorization,'Bearer ') === 1 ? substr($authorization,7) : '';

        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.';
        $token .= 'eyJpc3MiOiJhdXRoIiwic3ViIjoidG9rZW4iL';
        $token .= 'CJpYXQiOjE2NTcxODA5NDQsImV4cCI6MTY1NzI2NzM0NCwidWlkIjoxfQ.';
        $token .= 'qlxdFel1mqKRcx7S7kgJxovCUdAdoDNDeuQDT1qIW8Y';
        return $token;
    }

    /**
     * 编码 - JWT.
     *
     * @throws BizException
     */
    public static function encode(User $user): string
    {
        $time = time();
        $payload = [
            'iss' => 'auth',        // 签发者
            'sub' => 'token',       // 主题
            'iat' => $time,         // 签发时间
            'exp' => $time + 86400, // 过期时间 ( 1 天后 )
            'uid' => $user->id,     // 携带数据
        ];

        return JWT::encode($payload, self::key(), 'HS256');
    }

    /**
     * 解码 - JWT.
     *
     * @param string $jwt 已编码的 JWT 字符串
     * @return IDEJWTPayloadStdClass
     * @throws UnauthorizedException
     */
    public static function decode(string $jwt): stdClass
    {
        try {
            JWT::$leeway = 60; // 当前时间减去 60，留点余地
            return JWT::decode($jwt, new Key(self::key(), 'HS256'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw new UnauthorizedException();
        }
    }

    /**
     * 获取 - JWT Key.
     *
     * @throws BizException
     */
    protected static function key(): string
    {
        $key = Config::get('jwt.key');
        if (empty($key)) {
            throw new BizException('jwt.key 未设置');
        }

        return $key;
    }
}
