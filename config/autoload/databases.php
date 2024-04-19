<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-15 09:00:25
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-19 18:28:39
 * @FilePath: \join-his\join-his\config\autoload\databases.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

/**
 * 数据库 - 配置.
 *
 * @see https://hyperf.wiki/3.0/#/zh-cn/db/quick-start?id=%e9%85%8d%e7%bd%ae 数据库配置
 * @see https://hyperf.wiki/3.0/#/zh-cn/db/model-cache?id=%e9%85%8d%e7%bd%ae 模型缓存配置
 * @see https://hyperf.wiki/3.0/#/zh-cn/db/gen 创建模型脚本
 */
use Hyperf\Database\Commands\ModelOption;
use function Hyperf\Support\env;
// var_dump(env('DB_HOST', 'localhost'),"=============");
return [
    'default' => [
        'driver' => env('DB_DRIVER', 'mysql'),
        'host' => env('DB_HOST', 'localhost'),
        'database' => env('DB_DATABASE', 'hyperf'),
        'port' => env('DB_PORT', 3306),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', ''),
        'charset' => env('DB_CHARSET', 'utf8'),
        'collation' => env('DB_COLLATION', 'utf8_unicode_ci'),
        'prefix' => env('DB_PREFIX', ''),
        'pool' => [
            'min_connections' => 1,
            'max_connections' => 10,
            'connect_timeout' => 10.0,
            'wait_timeout' => 3.0,
            'heartbeat' => -1,
            'max_idle_time' => (float) env('DB_MAX_IDLE_TIME', 60),
        ],
        'commands' => [
            // 开发者工具生成模型文件配置
            'gen:model' => [
                'path' => 'core/Model',                              // 模型存储路径
                'inheritance' => 'AbstractModel',                    // 父类
                'uses' => '',                                        // 配合 inheritance 使用
                'table_mapping' => [],
                'force_casts' => true,                               // 是否强制重置 casts 参数
                'refresh_fillable' => true,                          // 是否刷新 fillable 参数
                'with_comments' => true,                             // 是否增加字段注释
                'property_case' => ModelOption::PROPERTY_CAMEL_CASE, // 字段类型 ( 0 蛇形 1 驼峰 )
                'visitors' => [
                    // 根据 created_at 和 updated_at 自动判断，是否启用默认记录 创建和修改时间 的功能
                    Hyperf\Database\Commands\Ast\ModelRewriteTimestampsVisitor::class,
                    // 可以根据 DELETED_AT 常量判断该模型是否含有软删除字段，如果存在，则添加对应的 Trait SoftDeletes
                    Hyperf\Database\Commands\Ast\ModelRewriteSoftDeletesVisitor::class,
                ],
            ],
        ],
    ],
    'join' => [
        'driver' => Hyperf\Database\Driver\MySQL\Driver::class,
        'host' => env('DB_SECOND_HOST', 'localhost'),
        'port' => env('DB_SECOND_PORT', 3306),
        'database' => env('DB_SECOND_DATABASE', 'hospital'),
        'username' => env('DB_SECOND_USERNAME', 'root'),
        'password' => env('DB_SECOND_PASSWORD', ''),
        'charset' => env('DB_SECOND_CHARSET', 'utf8mb4'),
        'collation' => env('DB_SECOND_COLLATION', 'utf8mb4_unicode_ci'),
        'prefix' => env('DB_SECOND_PREFIX', ''),
        'pool' => [
            'min_connections' => 1,
            'max_connections' => 10,
            'connect_timeout' => 10.0,
            'wait_timeout' => 3.0,
            'heartbeat' => -1,
            'max_idle_time' => (float) env('DB_MAX_IDLE_TIME', 60),
        ],
    ],
];

