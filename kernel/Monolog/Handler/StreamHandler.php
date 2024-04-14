<?php
/*
 * @Author: error: error: git config user.name & please set dead value or install git && error: git config user.email & please set dead value or install git & please set dead value or install git
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: error: error: git config user.name & please set dead value or install git && error: git config user.email & please set dead value or install git & please set dead value or install git
 * @LastEditTime: 2024-04-14 22:40:22
 * @FilePath: /hyperf-skeleton/kernel/Monolog/Handler/StreamHandler.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Kernel\Monolog\Handler;

use Monolog\Logger;
use Monolog\LogRecord;

/**
 * 流日志 - 处理器.
 *
 * 复写：isHandling()
 *
 * @see https://hyperf.wiki/3.0/#/zh-cn/logger
 */
class StreamHandler extends \Monolog\Handler\StreamHandler
{
    /**
     * 是否 - 处理日志.
     *
     * 说明：重写该方法，使得 [info、waring、notice] [debug] [error] 级别日志单独存储
     */
    public function isHandling(LogRecord $record): bool
    {
        return match ($record['level']) {
            Logger::DEBUG => $record['level'] == $this->level,
            $record['level'] >= Logger::ERROR => $this->level >= Logger::ERROR && $this->level <= Logger::EMERGENCY,
            default => $this->level >= Logger::INFO && $this->level <= Logger::WARNING,
        };
    }
}
