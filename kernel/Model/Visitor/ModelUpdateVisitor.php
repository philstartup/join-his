<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 04:27:36
 * @FilePath: /hyperf-skeleton/kernel/Model/Visitor/ModelUpdateVisitor.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

namespace Kernel\Model\Visitor;

use Hyperf\Stringable\Str;

/**
 * gen:model 时转化相关类型为其他类型.
 *
 * 例如：默认会将 decimal 转化成为 float，在这里重写即可转成想要的 decimal:2
 *
 * @see https://hyperf.wiki/3.0/#/zh-cn/db/gen
 */
class ModelUpdateVisitor extends \Hyperf\Database\Commands\Ast\ModelUpdateVisitor
{
    protected function formatDatabaseType(string $type): ?string
    {
        $newType = parent::formatDatabaseType($type);

        // 默认会将 decimal 转化成为 float，这里重写为 decimal:2
        if (is_null($newType) && $type === 'decimal') {
            $newType = 'decimal:2';
        }

        return $newType;
    }

    protected function formatPropertyType(string $type, ?string $cast): ?string
    {
        $cast = parent::formatPropertyType($type, $cast);

        // 如果 cast 为 decimal，则 @property 改为 string
        if (Str::startsWith($cast, 'decimal')) {
            return 'string';
        }

        return $cast;
    }
}
