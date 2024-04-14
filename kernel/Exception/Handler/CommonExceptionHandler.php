<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 02:30:48
 * @FilePath: /hyperf-skeleton/kernel/Exception/Handler/CommonExceptionHandler.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Kernel\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Codec\Json;
use Kernel\Exception\AbstractException;
use Kernel\Exception\DataSaveException;
use Kernel\Exception\Format\ExceptionMessage;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Throwable;

/**
 * 公共 - 异常处理器.
 */
class CommonExceptionHandler extends ExceptionHandler
{
    protected LoggerInterface $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        $this->logger = $loggerFactory->get('Exception');
    }

    /**
     * @param AbstractException $throwable
     */
    public function handle(Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        // 阻止异常冒泡
        $this->stopPropagation();

        // 记录日志
        $this->log($throwable);

        return $response
            ->withHeader('Content-Type', 'application/json; charset=utf-8')
            ->withStatus(200)
            ->withBody(new SwooleStream(
                // 格式化输出
                Json::encode([
                    'code' => $throwable->getCode(),
                    'message' => $throwable->getMessage(),
                ])
            ));
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof AbstractException;
    }

    /**
     * 记录 - 日志.
     */
    private function log(Throwable $t): void
    {
        $message = ExceptionMessage::format($t);

        switch (true) {
            case $t instanceof DataSaveException:
                // 先前错误
                $this->logger->error(ExceptionMessage::format($t->getPrevious()));

                // 当前错误
                $this->logger->error($message);
                // $this->logger->error($throwable->getTraceAsString());
                break;
            default:
                $this->logger->warning($message);
        }
    }
}
