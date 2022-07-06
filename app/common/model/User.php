<?php

namespace app\common\model;

use app\common\exception\BizException;
use app\common\ide\IDEJWTPayloadStdClass;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;
use think\Config;
use think\model\Collection;
use think\model\relation\BelongsToMany;

/**
 * 用户信息 - 模型.
 *
 * @property int $id 用户 ID
 * @property string $nickname 昵称
 * @property string $phone 手机
 * @property string $password 密码
 * @property string $salt 盐值
 * @property string $status 状态 ( enable-启用 disable-禁用 )
 * @property string $created_at 创建时间
 * @property string $updated_at 修改时间
 *
 * @property-read Collection|Role[] $roles 角色信息
 * @property-read array $permissionRoutes 权限路由
 */
class User extends BaseModel
{
    /**
     * 状态 - 启用.
     */
    public const STATUS_ENABLE = 'enable';

    /**
     * 状态 - 禁用.
     */
    public const STATUS_DISABLE = 'disable';

    /**
     * @var string 完整表名
     */
    protected $table = 'user';

    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';

    protected $autoWriteTimestamp = 'datetime';

    protected $type = [
        'created_at' =>  'datetime',
        'updated_at' =>  'datetime',
    ];

    public function getPermissionRoutesAttr(): array
    {
        /* @var Role $role */

        $routes = [];
        foreach ($this->roles->load('permissions') as $role) {
            $routes = array_unique(array_merge($routes, $role->permissions->column('route')));
        }

        return $routes;
    }

    /**
     * 编码 - JWT.
     *
     * @throws BizException
     */
    public function JWTEncode(): string
    {
        $key = Config::get('jwt_key');
        if (empty($key)) {
            throw new BizException('jwt_key 未设置');
        }

        $time = time();
        $payload = [
            'iss' => 'auth',                     // 签发者
            'sub' => 'token',                    // 主题
            'iat' => $time,                      // 签发时间
            'exp' => $time + 86400,              // 过期时间 ( 1 天后 )
            'uid' => $this->getAttr('id'), // 携带数据
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    /**
     * 解码 - JWT.
     *
     * @param string $jwt 已编码的 JWT 字符串
     * @return IDEJWTPayloadStdClass
     * @throws BizException
     */
    public function JWTDecode(string $jwt): stdClass
    {
        $key = Config::get('jwt_key');
        if (empty($key)) {
            throw new BizException('jwt_key 未设置');
        }

        JWT::$leeway = 60; // 把时间留点余地

        return JWT::decode($jwt, new Key($key, 'HS256'));
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, UserRole::class);
    }
}
