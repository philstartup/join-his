<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 03:11:30
 * @FilePath: /hyperf-skeleton/kernel/Repository/Traits/Searchable.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Kernel\Repository\Traits;

use Hyperf\Contract\PaginatorInterface;
use Hyperf\Database\Model\Builder;

use function Hyperf\Collection\data_set;

trait Searchable
{
    /**
     * Todo: 待完善.
     */
    public function search(array $searchParams, Builder $query = null, array $condition = null): PaginatorInterface
    {
        //$perPage = (int) data_get($searchParams, 'per_page', 20);
        $perPage =10;
        $query = $query ?? $this->getQuery();

        return $query->paginate($perPage);
    }
}
