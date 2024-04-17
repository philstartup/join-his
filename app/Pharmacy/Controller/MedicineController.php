<?php

declare(strict_types=1);

namespace App\Pharmacy\Controller;

use Core\Controller\AbstractController;
use Core\Request\SearchRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Kernel\Response\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * MedicineController - 控制器.
 */
#[Controller('MedicineController')]
class MedicineController extends AbstractController
{
    /**
     * MedicineController - 列表.
     */
    #[GetMapping('')]
    public function index(SearchRequest $request): ResponseInterface
    {
        return Response::success();
    }

    /**
     * MedicineController - 详情.
     */
    #[GetMapping('{id}')]
    public function show(int $id): ResponseInterface
    {
        return Response::success();
    }

    /**
     * MedicineController - 创建.
     */
    #[PostMapping('')]
    public function create(): ResponseInterface
    {
        return Response::success();
    }

    /**
     * MedicineController - 修改.
     */
    #[PutMapping('{id}')]
    public function update(int $id): ResponseInterface
    {
        return Response::success();
    }

    /**
     * MedicineController - 删除.
     */
    #[DeleteMapping('{id}')]
    public function delete(int $id): ResponseInterface
    {
        return Response::success();
    }
}
