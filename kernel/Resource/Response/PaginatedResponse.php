<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 04:28:08
 * @FilePath: /hyperf-skeleton/kernel/Resource/Response/PaginatedResponse.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Kernel\Resource\Response;

use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Codec\Json;
use Psr\Http\Message\ResponseInterface;

/**
 * 自定义分页 - 响应类.
 */
class PaginatedResponse extends \Hyperf\Resource\Response\PaginatedResponse
{
    public function toResponse(): ResponseInterface
    {
        return $this->response()
            ->withStatus($this->calculateStatus())
            ->withAddedHeader('content-type', 'application/json; charset=utf-8')
            ->withBody(new SwooleStream(Json::encode($this->wrap(
                array_merge_recursive(
                    $this->resource->resolve(),
                    $this->paginationInformation()
                ),
                array_merge_recursive(
                    $this->resource->with(),
                    $this->resource->additional
                )
            ))));
    }
}
