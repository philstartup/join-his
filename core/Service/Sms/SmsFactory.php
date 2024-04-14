<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 04:59:57
 * @FilePath: /hyperf-skeleton/core/Service/Sms/SmsFactory.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Core\Service\Sms;

use Core\Service\Captcha\CaptchaService;
use Core\Service\Captcha\CodeResult;
use Core\Service\Sms\Template\CaptchaMessage;
use function Hyperf\Support\make;
/**
 * 短信验证码 - 工厂类.
 */
class SmsFactory
{
    /**
     * 发送 - 验证码.
     *
     * @see CaptchaType::class 验证码类型
     * @param string $phone 手机号
     * @param string $type  验证码类型
     */
    public static function send(string $phone, string $type): CodeResult
    {
        // 1. 获取验证码
        $codeResult = make(CaptchaService::class)->genCode($phone, $type);

        // 2. 发送验证码
        co(fn () => make(SmsService::class)->send($phone, new CaptchaMessage($codeResult->code)));

        return $codeResult;
    }
}
