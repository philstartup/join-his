<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 04:57:51
 * @FilePath: /hyperf-skeleton/app/Admin/Request/Common/ChangePhoneSendRequest.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace App\Admin\Request\Common;

use Core\Constants\CaptchaType;
use Core\Constants\ContextKey;
use Core\Model\UserAdmin;
use Core\Request\FormRequest;
use Core\Service\Captcha\CaptchaService;
use Hyperf\Context\Context;
use Hyperf\Validation\Rule;
use function Hyperf\Support\make;
/**
 * 更换手机号 - 验证码发送 - 请求类.
 */
class ChangePhoneSendRequest extends FormRequest
{
    /**
     * @var $captchaService CaptchaService
     */
    public function rules(): array
    {
        $uid = Context::get(ContextKey::UID);

        return [
            'phone' => ['bail', 'required', 'string', 'mobile',
                Rule::unique(UserAdmin::table(), 'phone')->ignore($uid),
                function ($attribute, $value, $fail) {
                    if (make(CaptchaService::class)->canRenewGenCode((string) $value, CaptchaType::CHANGE_PHONE)) {
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
