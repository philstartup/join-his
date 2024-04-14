<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 04:16:37
 * @FilePath: /hyperf-skeleton/core/Model/Traits/TenantActionTrail.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

namespace Core\Model\Traits;
use function Hyperf\Config\config;
trait TenantActionTrail
{
    /**
     * 能否 - 修改.
     */
    public function canUpdate(): bool
    {
        return true;
    }

    /**
     * 能否 - 删除.
     */
    public function canDelete(): bool
    {
        return false;
    }

    /**
     * 能否 - 启用.
     */
    public function canEnable(): bool
    {
        return $this->isLock() === false;
    }

    /**
     * 能否 - 禁用.
     */
    public function canDisable(): bool
    {
        return $this->isLock() === false;
    }

    /**
     * 是否 - 锁定.
     */
    public function isLock(): bool
    {
        return $this->id === config('tenant.admin.id');
    }
}
