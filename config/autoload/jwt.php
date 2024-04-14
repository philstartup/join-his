<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-14 23:29:33
 * @FilePath: /hyperf-skeleton/config/autoload/jwt.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);
use function Hyperf\Support\env;
/**
 * JWT 配置.
 *
 * @see https://github.com/firebase/php-jwt 官网
 */
return [
    'key' => env('JWT_KEY'), // 加密 Key ( 32 位字符串 )
];
