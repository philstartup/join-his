<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 04:23:55
 * @FilePath: /hyperf-skeleton/kernel/Response/Response.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Kernel\Response;

use Hyperf\Context\Context;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Codec\Json;
use Psr\Http\Message\ResponseInterface;

/**
 * 响应类.
 *
 * @see \Hyperf\HttpServer\Response 参考
 */
class Response
{
    protected mixed $data;

    protected string $message = '';

    public function __construct(mixed $data = [], string $message = '')
    {
        $this->data = $data;
        $this->message = $message;
    }

    /**
     * 输出空数据.
     */
    public static function withEmpty(): ResponseInterface
    {
        return (new self())->toJson();
    }

    /**
     * 输出数据.
     */
    public static function withData(mixed $data = [], string $message = '操作成功'): ResponseInterface
    {
        return (new self($data, $message))->toJson();
    }

    /**
     * 执行成功.
     */
    public static function success(string $message = '操作成功'): ResponseInterface
    {
        return (new self([], $message))->toJson();
    }

    protected function toJson(): ResponseInterface
    {
        return $this->response()
            ->withAddedHeader('content-type', 'application/json; charset=utf-8')
            ->withBody(new SwooleStream(Json::encode([
                'code' => 200,
                'message' => $this->message,
                'data' => $this->data,
            ])));
    }

    protected function response(): ResponseInterface
    {
        return Context::get(ResponseInterface::class);
    }
}
