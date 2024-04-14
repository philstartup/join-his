<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 04:24:16
 * @FilePath: /hyperf-skeleton/kernel/Exception/Handler/ValidationExceptionHandler.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Kernel\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Codec\Json;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * 验证类 - 异常处理器.
 */
class ValidationExceptionHandler extends ExceptionHandler
{
    /**
     * @param ValidationException $throwable
     */
    public function handle(Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        // 阻止异常冒泡
        $this->stopPropagation();

        return $response
            ->withHeader('Content-Type', 'application/json; charset=utf-8')
            ->withStatus(200)
            ->withBody(new SwooleStream(Json::encode([
                'code' => 422,
                'message' => $throwable->validator->errors()->first(),
            ])));
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ValidationException;
    }
}
