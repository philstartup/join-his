<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-15 04:28:28
 * @FilePath: /hyperf-skeleton/kernel/Service/Collector/RoutesCollector.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Kernel\Service\Collector;

use Hyperf\HttpServer\Router\DispatcherFactory;
use Hyperf\HttpServer\Router\Handler;
use Hyperf\HttpServer\Router\RouteCollector;
use Hyperf\Collection\Collection;
use Hyperf\Stringable\Str;
use Kernel\Service\Collector\Result\RouteResult;
use Psr\Container\ContainerInterface;
use function Hyperf\Collection\collect;
/**
 * 路由 - 收集器.
 *
 * @see RoutesCommand::class 参考: devtool 组件 ( 通过执行命令行 php bin/hyperf.php describe:routes 获取路由信息 )
 */
class RoutesCollector
{
    private string $server = 'http';

    private RouteCollector $router;

    public function __construct(ContainerInterface $container)
    {
        $this->router = $container->get(DispatcherFactory::class)->getRouter($this->server);
    }

    /**
     * 执行.
     *
     * @see RoutesCollectorTest::testHandle()
     * @return Collection|RouteResult[]
     */
    public function handle(): array|Collection
    {
        return collect($this->analyzeRouter($this->server, $this->router, null));
    }

    /**
     * 分析 - 路由.
     *
     * @see RoutesCommand::analyzeRouter() Copy 该方法
     */
    protected function analyzeRouter(string $server, RouteCollector $router, ?string $path): array
    {
        $data = [];
        [$staticRouters, $variableRouters] = $router->getData();

        foreach ($staticRouters as $method => $items) {
            foreach ($items as $handler) {
                $this->analyzeHandler($data, $server, $method, $path, $handler);
            }
        }
        foreach ($variableRouters as $method => $items) {
            foreach ($items as $item) {
                if (is_array($item['routeMap'] ?? false)) {
                    foreach ($item['routeMap'] as $routeMap) {
                        $this->analyzeHandler($data, $server, $method, $path, $routeMap[0]);
                    }
                }
            }
        }

        return $data;
    }

    /**
     * @see RoutesCommand::analyzeHandler() Copy 该方法并做调整
     */
    protected function analyzeHandler(array &$data, string $serverName, string $method, ?string $path, Handler $handler): void
    {
        if (! is_null($path) && ! Str::contains($handler->route, $path)) {
            return;
        }

        // 动作: 类名::方法
        if (is_array($handler->callback)) {
            $action = $handler->callback[0] . '::' . $handler->callback[1];
        } elseif (is_string($handler->callback)) {
            $action = $handler->callback;
        } else {
            $action = 'Closure';
        }

        $unique = $method . ':' . $handler->route;
        $data[$unique] = RouteResult::make([
            'server' => $serverName,
            'method' => $method,
            'route' => $handler->route,
            'action' => $action,
        ]);
    }
}
