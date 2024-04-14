<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 04:19:44
 * @FilePath: /hyperf-skeleton/core/Model/Traits/StatusTrait.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Core\Model\Traits;

use Core\Constants\Status;
use Hyperf\Database\Model\Builder;
use Hyperf\Collection\Collection;
use function Hyperf\Collection\collect;
/**
 * 通用状态 - 模型.
 *
 * @property string $status 状态 ( enable-启用 disable-禁用 )
 *
 * @property string     $statusText     状态 - 文字
 * @property Collection $statusKeyValue 状态 - keyValue
 *
 * @method static Builder enable()  查询 [ 已启用 ] 作用域
 * @method static Builder disable() 查询 [ 已禁用 ] 作用域
 */
trait StatusTrait
{
    public function getStatusTextAttribute(): string
    {
        return Status::getText($this->status);
    }

    public function getStatusKeyValueAttribute(): Collection
    {
        return collect(Status::dict('Text'))->map(fn (array $item) => [
            'key' => $item['key'],
            'value' => $item['value'],
            'isSelect' => $item['key'] === $this->status,
        ]);
    }

    /**
     * 只包含 [ 已启用 ] 的查询作用域.
     */
    public function scopeEnable(Builder $query): Builder
    {
        return $query->where(self::column('status'), Status::ENABLE);
    }

    /**
     * 只包含 [ 已禁用 ] 的查询作用域.
     */
    public function scopeDisable(Builder $query): Builder
    {
        return $query->where(self::column('status'), Status::DISABLE);
    }

    /**
     * 是否启用.
     */
    public function isEnable(): bool
    {
        return $this->status === Status::ENABLE;
    }

    /**
     * 是否禁用.
     */
    public function isDisable(): bool
    {
        return $this->status === Status::DISABLE;
    }
}
