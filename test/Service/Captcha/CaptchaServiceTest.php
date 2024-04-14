<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 05:03:04
 * @FilePath: /hyperf-skeleton/test/Service/Captcha/CaptchaServiceTest.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

namespace HyperfTest\Service\Captcha;

use Core\Constants\CaptchaType;
use Core\Service\Captcha\CaptchaService;
use Exception;
use PHPUnit\Framework\TestCase;
use function Hyperf\Support\make;
class CaptchaServiceTest extends TestCase
{
    protected CaptchaService $service;

    protected string $mobile = '13800138000';

    public function setUp(): void
    {
        parent::setUp();
        $this->service = make(CaptchaService::class);
    }

    public function testGetCodeByCache(): void
    {

    }

    public function testCheckCode(): void
    {

    }

    /**
     * @throws Exception
     * @see CaptchaService::genCode()
     */
    public function testGenCode(): void
    {
        $code = $this->service->genCode($this->mobile, CaptchaType::LOGIN);
        var_dump($code);

        self::assertTrue(true);
    }

    /**
     * @see CaptchaService::canRenewGenCode()
     */
    public function testCanRenewGenCode(): void
    {
        $res = $this->service->canRenewGenCode($this->mobile, CaptchaType::LOGIN);
        var_dump($res);

        self::assertTrue(true);
    }

    public function testDelCodeByCache(): void
    {

    }
}
