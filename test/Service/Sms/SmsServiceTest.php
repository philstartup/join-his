<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 05:03:13
 * @FilePath: /hyperf-skeleton/test/Service/Sms/SmsServiceTest.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

namespace HyperfTest\Service\Sms;

use Core\Service\Sms\SmsService;
use Core\Service\Sms\Template\CaptchaMessage;
use PHPUnit\Framework\TestCase;
use function Hyperf\Support\make;
class SmsServiceTest extends TestCase
{
    /**
     * @see SmsService::send()
     */
    public function testSend()
    {
        $phone = '15800000000';
        $smsService = make(SmsService::class);
        $smsService->send($phone, new CaptchaMessage('0000'));

        self::assertTrue(true);
    }
}
