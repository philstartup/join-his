<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 04:59:15
 * @FilePath: /hyperf-skeleton/core/Command/CollectPermissionsCommand.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Core\Command;

use Core\Service\Collector\PermissionsCollector;
use Hyperf\Command\Annotation\Command;
use function Hyperf\Support\make;
/**
 * 收集路由权限节点 - 命令行.
 */
#[Command]
class CollectPermissionsCommand extends AbstractCommand
{
    public function __construct()
    {
        parent::__construct('collect:permissions');
    }

    public function configure(): void
    {
        parent::configure();
        $this->setDescription('收集路由权限节点, 可随意重复执行');
    }

    public function handle(): void
    {
        make(PermissionsCollector::class)->handle();

        $this->_timerStop(); // 输出耗时和内存使用量
    }
}
