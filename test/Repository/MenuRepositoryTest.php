<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 05:02:50
 * @FilePath: /hyperf-skeleton/test/Repository/MenuRepositoryTest.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

namespace HyperfTest\Repository;

use Core\Constants\AppId;
use Core\Repository\MenuRepository;
use PHPUnit\Framework\TestCase;
use function Hyperf\Support\make;
class MenuRepositoryTest extends TestCase
{
    /**
     * @see MenuRepository::getTrees()
     */
    public function testGetTrees()
    {
        // 获取总后台菜单树
        $menus = make(MenuRepository::class)->getTrees(AppId::ADMIN);
        var_dump($menus);

        self::assertTrue(true);
    }

    /**
     * @see MenuRepository::getList()
     */
    public function testGetList()
    {
        // 获取总后台菜单
        $menus = make(MenuRepository::class)->getList(AppId::ADMIN);
        var_dump($menus->toArray());

        self::assertTrue(true);
    }
}
