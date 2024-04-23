<?php

namespace Core\Service\Pharmacy;

use Core\Exception\BusinessException;
use Core\Model\PmsDrugManufacturer;
use Core\Repository\Pharmacy\ManufacturerRepository;
use Core\Service\AbstractService;
use Hyperf\Contract\PaginatorInterface;
use Hyperf\Di\Annotation\Inject;

class ManufacturerService extends AbstractService
{
    #[Inject]
    protected ManufacturerRepository $repo;



    /**
     * 获取厂商列表
     * @param array $searchParams 搜索参数
     * @return PaginatorInterface
     */
    public function getManufacturerList(array $searchParams = []): PaginatorInterface
    {
        $params['is_deleted'] = 0;
        return $this->repo->getManufacturerList($params);
    }



    /**
     * 获取厂商详情
     * @param int $id
     * @return PmsDrug
     */
    public function getManufacturerDetail(int $id): PmsDrug
    {
        $params['id'] = $id;
        $params['is_deleted'] = 0;
        return $this->repo->getManufacturerDetail($params);
    }

    /**
     * 添加厂商
     * @param array $params
     * @return bool
     */
    public function addManufacturer(array $params): bool
    {
        $params['is_deleted'] = 0;
        return $this->repo->addManufacturer($params);
    }

    /**
     * 修改厂商
     * @param array $params
     * @return bool
     */
    public function updateManufacturer(array $params): bool
    {
        $params['is_deleted'] = 0;
        return $this->repo->updateManufacturer($params);
    }

    /**
     * 删除厂商
     * @param int $id
     * @return bool
     */
    public function deleteManufacturer(int $id): bool
    {
         $params['id'] = $id;
         $params['is_deleted'] = 1;
         return $this->repo->updateManufacturer($params);
    }

    /**
     * 检查厂商名称是否存在
     * @param string $name
     * @param int $id
     * @return bool
     */
    public function checkManufacturerName(string $name, int $id = 0): bool
    {
        $params['name'] = $name;    
        $params['is_deleted'] = 0;
        $params['id'] = $id;
        return $this->repo->checkManufacturerName($params);
    }

    /**
     * 检查厂商编码是否存在
     * @param string $code
     * @param int $id
     * @return bool
     */
    public function checkManufacturerCode(string $code, int $id = 0): bool
    {
            
        $params['code'] = $code;    
        $params['is_deleted'] = 0;
        $params['id'] = $id;
        return $this->repo->checkManufacturerCode($params);
    }

 
}