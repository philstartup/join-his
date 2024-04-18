<?php

declare(strict_types=1);

namespace Core\Repository;

use Core\Constants\AppId;
use Core\Model\PmsDrug;
use Core\Exception\BusinessException;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Model;
use Hyperf\Database\Model\Builder;
use Kernel\Helper\TreeHelper;

/**
 * 测试 - 仓库类.
 *
 * @method Test getById(int $id)
 * @method Test create(array $data)
 * @method Test update(Test $model, array $data)
 */
class PmsDrugRepository extends AbstractRepository
{
    protected Model|string $modelClass = PmsDrug::class;

    // /**
    //  * 菜单 - 列表.
    //  *
    //  * @see MenuRepositoryTest::testGetList()
    //  *
    //  * @return Collection|PmsDrug[]
    //  */
    // public function getList(string $appId = null, string $status = null): array|Collection
    // {
    //     if ($appId && ! AppId::has($appId)) {
    //         throw new BusinessException('传入的 [ 终端平台 ] 参数不合法');
    //     }
  
    //     return $this->getQuery()
    //         ->when($appId, fn (Builder $query) => $query->where(PmsDrug::column('app_id'), $appId))
    //         ->orderByDesc(PmsDrug::column('sort'))
    //         ->orderBy(PmsDrug::column('id'))
    //         ->get();
    // }

    // /**
    //  * 菜单 - 树.
    //  *
    //  * @see MenuRepositoryTest::testGetTrees()
    //  */
    // public function getTrees(string $appId = null, string $status = null): array
    // {
    //     return TreeHelper::toTrees(
    //         $this->getList($appId, $status)->toArray()
    //     );
    // }
}
