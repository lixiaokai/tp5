<?php

namespace app\common\service;

use app\common\model\User;
use think\Config;
use think\exception\DbException;
use traits\think\Instance;

/**
 * 用户授权 - 服务类.
 */
class AuthService
{
    use Instance;

    /**
     * @var array 配置参数
     */
    protected $config = [
        'identityColumn'        => 'phone',     // 唯一标识列 ( 用户表中任何 [ 唯一列 ( unique column ) ] 都可以作为标识列 )

        'minPasswordLength'     => 6,           // 密码最小长度

        'trackLoginAttempts'    => false,       // 是否记录登录尝试
        'maximumLoginAttempts'  => 5,           // 最大登录尝试次数

    ];

    /**
     * @var null|string 错误消息
     */
    protected $error;

    public function __construct()
    {
        $this->config = array_merge($this->config, Config::get('auth') ?? []);
    }

    /**
     * 登录.
     *
     * @throws DbException
     */
    public function login(string $identity, string $password, bool $remember = false): bool
    {
        // 1. 检查输入的账号和密码
        if (empty($identity) || empty($password)) {
            return $this->setError('登录失败');
        }
        // 2. 检查是否超过最大登录次数
        if ($this->isMaxLoginAttemptsExceeded($identity)) {
            return $this->setError('账号暂时被锁定，请稍后再试');
        }

        // 根据账号标识获取用户信息
        $user = User::get([$this->config['identityColumn'] => $identity]);

        // 3. 检查用户账号
        if (! $user) {
            return $this->setError('账号不存在，请联系账号管理员处理');
        }
        // 4. 检查用户状态
        if ($user->status === User::STATUS_DISABLE) {
            return $this->setError('账号已禁用，请联系账号管理员处理');
        }
        // 5. 验证密码
        if (! self::verifyPassword($password, $user->salt, $user->password)) {
            return $this->setError('密码错误，请重新输入');
        }

        // 记住用户
        $remember && $this->rememberUser($identity);

        return true;
    }

    /**
     * 退出.
     */
    public function logout(): bool
    {
        return true;
    }

    /**
     * 创建.
     */
    public function create(string $identity, string $password, string $email, array $additionalData = [], array $groupIds = [])
    {

    }

    /**
     * 更新.
     */
    public function update(int $id, array $data): bool
    {
        return true;
    }

    /**
     * 删除.
     */
    public function delete(int $id): bool
    {
        return true;
    }

    /**
     * 忘记密码.
     */
    public function forgotPassword(string $identity)
    {

    }

    /**
     * 检查 - 忘记密码是否有效?
     */
    public function forgotPasswordCheck(string $code)
    {

    }

    /**
     * 是否登录.
     */
    public function isLogin(): bool
    {
        return true;
    }

    /**
     * 是否后台管理员.
     */
    public function isAdmin(int $id): bool
    {
        return true;
    }

    /**
     * 检查 - 是否超过最大登录次数.
     */
    public function isMaxLoginAttemptsExceeded(string $identity, ?string $ipAddress = null): bool
    {
        if ($this->config['trackLoginAttempts']) {
            $maxAttempts = $this->config['maximumLoginAttempts'];
            return $maxAttempts > 0 && $this->getAttemptsNum($identity, $ipAddress) > $maxAttempts;
        }

        return false;
    }

    /**
     * 获取 - 登录失败次数.
     */
    public function getAttemptsNum(string $identity, ?string $ipAddress = null): int
    {
        if ($this->config['trackLoginAttempts']) {
            // Todo: 待实现
            return 1;
        }

        return 0;
    }

    /**
     * 清除 - 登录失败次数.
     */
    public function clearLoginAttempts(string $identity): bool
    {
        return true;
    }

    /**
     * 获取 - 最近一次尝试登录的 IP 地址.
     */
    public function getLastAttemptIp(string $identity): string
    {
        return '';
    }

    /**
     * 增加 - 尝试登录.
     */
    public function increaseLoginAttempts(string $identity): bool
    {
        return false;
    }

    /**
     * 加密 - 密码.
     */
    protected static function hashPassword(string $password, string $salt = ''): string
    {
        return md5(md5($password . $salt ?: self::getSalt()));
    }

    /**
     * 验证 - 密码.
     *
     * @param string $password       输入的密码
     * @param string $hashSaltDb     数据表的盐值
     * @param string $hashPasswordDb 数据表密码
     * @return bool
     */
    protected static function verifyPassword(string $password, string $hashSaltDb, string $hashPasswordDb): bool
    {
        return md5(md5($password . $hashSaltDb)) === $hashPasswordDb;
    }

    /**
     * 获取 - 密码盐值.
     */
    protected static function getSalt(): string
    {
        return md5(uniqid(mt_rand(), true));
    }

    /**
     * 记住 - 用户登录.
     */
    public function rememberUser(string $identity): void
    {

    }

    /**
     * 设置 - 错误信息.
     */
    protected function setError(string $error): bool
    {
        $this->error = $error;

        return false;
    }

    /**
     * 获取 - 错误信息.
     */
    public function getError(): ?string
    {
        return $this->error;
    }
}
