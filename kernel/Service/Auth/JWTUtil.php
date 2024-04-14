<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 00:37:48
 * @FilePath: /hyperf-skeleton/kernel/Service/Auth/JWTUtil.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Kernel\Service\Auth;

use Hyperf\Context\ApplicationContext;
use Psr\Http\Message\ServerRequestInterface;

/**
 * JWT - 工具类.
 */
class JWTUtil
{
    /**
     * 获取 - 客户端请求 token.
     */
    public static function getRequestToken(): string
    {
        $request = ApplicationContext::getContainer()->get(ServerRequestInterface::class);

        return trim(str_ireplace('bearer', '', $request->getHeaderLine('authorization')));
    }
}
