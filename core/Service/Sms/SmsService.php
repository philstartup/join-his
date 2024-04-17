<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-14 21:41:37
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-17 18:29:04
 * @FilePath: /hyperf-skeleton/core/Service/Sms/SmsService.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Core\Service\Sms;

use Core\Exception\BusinessException;
use Core\Service\AbstractService;
use Hyperf\Config\Annotation\Value;
use Overtrue\EasySms\Contracts\MessageInterface;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\Exception;
use Overtrue\EasySms\Exceptions\InvalidArgumentException;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;
use Psr\Container\ContainerInterface;
use function Hyperf\Support\make;
use function Hyperf\Collection\data_get;
class SmsService extends AbstractService
{
    /**
     * @see config/autoload/easySms.php
     */
    #[Value('easySms')]
    protected array $config = [];

    protected EasySms $easySms;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->easySms = make(EasySms::class, [$this->config]);
    }

    /**
     * 发送 - 短信.
     *
     * @see SmsServiceTest::testSend()
     */
    public function send(string|array $phone, MessageInterface|array $message, array $gateways = [])
    {
        if (! $this->isEnable()) {
            return;
        }

        try {
            $this->easySms->send($phone, $message, $gateways);
        } catch (InvalidArgumentException $e) {
            throw new BusinessException($e->getMessage());
        } catch (NoGatewayAvailableException $e) {
            /** @var Exception $exception */
            $exception = $e->getLastException();
            $this->logger->warning($exception->getMessage(), ['code' => $exception->getCode()]);

            throw new BusinessException('短信发送异常');
        }
    }

    /**
     * 是否 - 启用.
     *
     * 启用后才会真实发送短信.
     */
    protected function isEnable(): bool
    {
        return data_get($this->config, 'isEnable') === true;
    }
}
