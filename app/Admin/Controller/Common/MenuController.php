<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-15 09:00:24
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-18 11:12:04
 * @FilePath: \join-his\join-his\app\Admin\Controller\Common\MenuController.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace App\Admin\Controller\Common;

use App\Admin\Middleware\AuthMiddleware;
use Core\Controller\AbstractController;
use Core\Service\User\UserAdminMenuService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middlewares;
use Kernel\Response\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * 公共 - 控制器.
 *
 * 需要登录但不需要权限验证的接口
 */
#[Controller('admin/common/menu')]
#[Middlewares([AuthMiddleware::class])]
class MenuController extends AbstractController
{
    #[Inject]
    protected UserAdminMenuService $service;

    /**
     * 菜单 - 列表 ( 树 ).
     */
    #[GetMapping('')]
    public function listTrees(): ResponseInterface
    {
        $menuTrees = $this->service->getMenuTrees();

        return Response::withData($menuTrees, ''); // 不输出提示
    }
}
