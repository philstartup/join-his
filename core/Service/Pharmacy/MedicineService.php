<?php

namespace Core\Service\Pharmacy;

use Core\Exception\BusinessException;
use Core\Model\PmsDrug;
use Core\Repository\PmsDrugRepository;
use Core\Service\AbstractService;
use Hyperf\Contract\PaginatorInterface;
use Hyperf\Di\Annotation\Inject;
use Kernel\Exception\NotFoundException;

class MedicineService extends AbstractService
{
    #[Inject]
    protected PmsDrugRepository $repo;

    public function search(array $searchParams = []): PaginatorInterface
    {
        $query = $this->repo->getQuery()->orderByDesc('id');

        return $this->repo->search($searchParams, $query);
    }

}