<?php

namespace Core\Service\Pharmacy;

use Core\Model\PmsDict;
use Core\Service\AbstractService;
use Core\Repository\Pharmacy\DictRepository;
use Hyperf\Contract\PaginatorInterface;
use Hyperf\Di\Annotation\Inject;

class DictService extends AbstractService
{
    #[Inject]
    protected DictRepository $repo;

    /**
     * 获取字典列表
     * @param array $searchParams 搜索参数
     * @return PaginatorInterface
     */
    public function getDictList(array $searchParams = []): PaginatorInterface
    {
        return $this->repo->getQuery($searchParams)->orderBy('id', 'desc')->paginate();
    }

    /**
     * 获取字典详情
     * @param int $id
     * @return PmsDict
     */
    public function getDictDetail(int $id): PmsDict
    {
        return $this->repo->getById($id);
    }

    /**
     * 新增字典
     * @param array $params
     * @return bool
     */
    public function addDict(array $params): bool
    {
        return $this->repo->addDict($params);
    }

    /**
     * 更新字典
     * @param array $params
     * @return bool
     */
    public function updateDict(array $params): bool
    {
        return $this->repo->updateDict($params);
    }

    /**
     * 删除字典
     * @param int $id
     * @return bool
     */
    public function deleteDict(int $id): bool
    {
        return $this->repo->deleteDict($id);
    }


}