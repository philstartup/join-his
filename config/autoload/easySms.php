<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-14 23:32:31
 * @FilePath: /hyperf-skeleton/config/autoload/easySms.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

/**
 * 短信发送配置.
 *
 * @see https://github.com/overtrue/easy-sms
 */
use Overtrue\EasySms\Strategies\OrderStrategy;
use function Hyperf\Support\env;
return [
    // 是否开启 ( 自定义配置 )
    'isEnable' => env('SMS_IS_ENABLE', false),
    // 默认发送配置
    'default' => [
        // 网关调用策略 ( 默认：顺序调用 )
        'strategy' => OrderStrategy::class,
        // 默认可用的发送网关
        'gateways' => ['aliyun'],
    ],
    // 网关配置
    'gateways' => [
        'errorlog' => [
            'file' => BASE_PATH . '/runtime/logs/easySmsError.log',
        ],
        // 阿里云短信
        'aliyun' => [
            'access_key_id' => env('ALIYUN_SMS_AK'),
            'access_key_secret' => env('ALIYUN_SMS_SK'),
            'sign_name' => env('SMS_SIGN'),
        ],
    ],

    // HTTP 请求的超时时间（秒）
    // 'timeout' => 5.0, // 默认为 5 秒
];
