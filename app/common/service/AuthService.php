<?php

namespace app\common\service;

/**
 * 用户授权 - 服务类.
 */
class AuthService
{
    /**
     * 登录.
     */
    public function login(string $identity, string $password, bool $remember = false): bool
    {

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
     * 获取 - 登录失败次数.
     */
    public function getAttemptsNum(string $identity)
    {

    }

    /**
     * 清除 - 登录失败次数.
     */
    public function clearLoginAttempts(string $identity)
    {

    }
}