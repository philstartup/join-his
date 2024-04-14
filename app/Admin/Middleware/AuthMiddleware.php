<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 03:46:19
 * @FilePath: /hyperf-skeleton/app/Admin/Middleware/AuthMiddleware.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace App\Admin\Middleware;

use Core\Constants\AppId;
use Core\Constants\ContextKey;
use Core\Exception\BusinessException;
use Core\Model\UserAdmin;
use Core\Service\User\UserAdminService;
use Hyperf\Context\Context;
use Hyperf\Di\Annotation\Inject;
use Kernel\Exception\NotFoundException;
use Kernel\Service\Auth\JWTAuth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use function Hyperf\Config\config;
/**
 * 总后台认证 - 中间件.
 */
class AuthMiddleware implements MiddlewareInterface
{
    #[Inject]
    protected UserAdminService $userAdminService;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->setUser();

        return $handler->handle($request);
    }

    /**
     * 设置 - 用户信息上下文.
     *
     * 以便全局上调用
     */
    protected function setUser()
    {
        $userAdmin = $this->getUser();

        Context::set(ContextKey::APP_ID, AppId::ADMIN); // 注入应用 ID
        Context::set(ContextKey::TENANT_ID, config('tenant.admin.id')); // 注入租户 ID
        Context::set(ContextKey::UID, $userAdmin->id); // 注入用户 ID
        Context::set(ContextKey::USER_ADMIN, $userAdmin); // 注入总后台用户模型
        Context::set(ContextKey::USER, $userAdmin->user); // 注入基础用户模型
    }

    /**
     * 获取 - 用户信息.
     */
    protected function getUser(): UserAdmin
    {
        try {
            $userAdmin = $this->userAdminService->getById(self::getUid());
        } catch (NotFoundException $e) {
            throw new BusinessException('[Auth] 当前账号不存在');
        }

        if ($userAdmin->isDisable()) {
            throw new BusinessException('[Auth] 当前账号已禁用，请联系管理员');
        }
        if ($userAdmin->user->isDisable()) {
            throw new BusinessException('[Auth] 基础账号已禁用，请联系管理员');
        }

        return $userAdmin;
    }

    /**
     * 获取 - uid.
     *
     * 通过 JWT Token 获取
     */
    protected static function getUid(): int
    {
        return self::injectUidForDev() ?? JWTAuth::uid();
    }

    /**
     * 注入 - uid.
     *
     * 开发环境可临时取消下面注释来注入 uid 实现快速切换用户
     */
    protected static function injectUidForDev(): ?int
    {
        if (config('app_env') === 'dev') {
            return 1;
        }

        return null;
    }
}
