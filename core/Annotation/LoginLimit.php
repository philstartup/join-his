<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-14 23:31:24
 * @FilePath: /hyperf-skeleton/config/autoload/jwt.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */


declare(strict_types=1);

namespace Core\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * 登录限制 - 注解.
 *
 * @example
 * ```
 * #[LoginLimit(id: 'phone', prefix: 'admin')]
 * ```
 */
#[Attribute(Attribute::TARGET_METHOD)]
class LoginLimit extends AbstractAnnotation
{
    public function __construct($id,$prefix)
    {
        $this->id = $id;
        $this->prefix = $prefix;
    }
    /**
     * @var string 必填唯一标识 ( 例如：输入的手机号、邮箱、账号等 )
     */
    public string $id;

    /**
     * @var int 监控秒数 ( 多少秒内 )
     */
    public int $watchSeconds = 60;

    /**
     * @var int 锁定秒数 ( 默认 600 秒 )
     */
    public int $lockSeconds = 600;

    /**
     * @var int 最大尝试次数
     */
    public int $maxAttempts = 5;

    /**
     * @var string 前缀 Key ( 默认为空字符串 )
     */
    public string $prefix = '';
}
