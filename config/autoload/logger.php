<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-14 23:30:45
 * @FilePath: /hyperf-skeleton/config/autoload/jwt.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */


declare(strict_types=1);

use Kernel\Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;

use function Hyperf\Support\env;
/**
 * 日志 - 配置文件.
 *
 * @see https://hyperf.wiki/3.0/#/zh-cn/logger
 */

$_appEnv = env('APP_ENV', 'dev');
$_formatter = [
    'class' => LineFormatter::class,
    'constructor' => [
        'format' => "[%level_name%] [%datetime%] %channel% %message% %context% %extra%\n",
        'dateFormat' => 'Y-m-d H:i:s',
        'allowInlineLineBreaks' => true,
    ],
];

return [
    'default' => [
        'handlers' => [
            // debug 日志
            [
                'class' => StreamHandler::class,
                'constructor' => [
                    'stream' => $_appEnv === 'dev' ? 'php://stdout' : BASE_PATH . '/runtime/logs/hyperf-debug.log',
                    'level' => Logger::DEBUG,
                ],
                'formatter' => $_formatter,
            ],
            // info、waring、notice 日志
            [
                'class' => StreamHandler::class,
                'constructor' => [
                    'stream' => $_appEnv === 'dev' ? 'php://stdout' : BASE_PATH . '/runtime/logs/hyperf.log',
                    'level' => Logger::INFO,
                ],
                'formatter' => $_formatter,
            ],
            // error 日志
            [
                'class' => StreamHandler::class,
                'constructor' => [
                    'stream' => $_appEnv === 'dev' ? 'php://stdout' : BASE_PATH . '/runtime/logs/hyperf-error.log',
                    'level' => Logger::ERROR,
                ],
                'formatter' => $_formatter,
            ],
        ],
    ],
];
