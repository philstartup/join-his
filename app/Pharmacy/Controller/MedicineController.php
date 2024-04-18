<?php

declare(strict_types=1);

namespace App\Pharmacy\Controller;

use App\Pharmacy\Collection\DrugCollection;
use App\Pharmacy\Resource\DrugResource;
use Core\Controller\AbstractController;
use Core\Request\SearchRequest;
use Core\Service\Pharmacy\MedicineService;
use Hyperf\Di\Annotation\Inject;
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
#[Controller('pharmacy/medicine')]
class MedicineController extends AbstractController
{
    #[Inject]
    protected MedicineService $service;
    /**
     * MedicineController - 列表.
     */
    #[GetMapping('list')]
    public function list(SearchRequest $request): ResponseInterface
    {
     
        $data = $this->service->search($request->searchParams());
        // return DrugCollection::make($data);
        return Response::withData($data);
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
    public function add(): ResponseInterface
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
