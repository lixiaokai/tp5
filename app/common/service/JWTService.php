<?php

namespace app\common\service;

use app\common\exception\BizException;
use app\common\ide\IDEJWTPayloadStdClass;
use app\common\model\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;
use think\Config;

class JWTService
{
    /**
     * 支持：ES384、ES256、HS256、HS384、HS512、RS256、RS384、RS512.
     *
     * @var string 算法
     */
    public static $alg = 'HS256';

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

        return JWT::encode($payload, self::key(), self::$alg);
    }

    /**
     * 解码 - JWT.
     *
     * @param string $jwt 已编码的 JWT 字符串
     * @return IDEJWTPayloadStdClass
     * @throws BizException
     */
    public static function decode(string $jwt): stdClass
    {
        JWT::$leeway = 60; // 当前时间减去 60，留点余地
        return JWT::decode($jwt, new Key(self::key(), self::$alg));
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
