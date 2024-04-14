<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 04:58:54
 * @FilePath: /hyperf-skeleton/app/Admin/Request/Public/SmsLoginSendRequest.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

namespace App\Admin\Request\Public;

use Core\Constants\CaptchaType;
use Core\Request\FormRequest;
use Core\Service\Captcha\CaptchaService;
use function Hyperf\Support\make;
/**
 * 验证码发送 - 请求类.
 */
class SmsLoginSendRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => ['bail', 'required', 'string', 'mobile', 'exists:user_admin,phone', function ($attribute, $value, $fail) {
                if (make(CaptchaService::class)->canRenewGenCode((string) $value, CaptchaType::LOGIN)) {
                    return true;
                }
                return $fail('1 分钟仅可发送 1 次，请稍后再试');
            }],
        ];
    }

    public function attributes(): array
    {
        return [
            'phone' => '手机号',
        ];
    }
}
