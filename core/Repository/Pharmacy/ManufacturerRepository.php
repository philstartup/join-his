<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-18 10:25:24
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-23 14:10:35
 * @FilePath: \join-his\join-his\core\Repository\Pharmacy\PmsDrugRepository.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Core\Repository\Pharmacy;

use Core\Constants\AppId;
use Core\Model\PmsDrugManufacturer;
use Core\Exception\BusinessException;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Model;
use Hyperf\Database\Model\Builder;
use Kernel\Helper\TreeHelper;
use Core\Repository\AbstractRepository;
/**
 * 测试 - 仓库类.
 *
 * @method Test getById(int $id)
 * @method Test create(array $data)
 * @method Test update(Test $model, array $data)
 */
class ManufacturerRepository extends AbstractRepository
{
    protected Model|string $modelClass = PmsDrugManufacturer::class;

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