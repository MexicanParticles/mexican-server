<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Illuminate\Config\Repository;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\RedisAdapter;

return function (ContainerBuilder $containerBuilder): void {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c): LoggerInterface {
            $settings = $c->get('settings');
            assert($settings instanceof Repository);

            $logger = new Logger($settings->get('logger.name'));

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($settings->get('logger.path'), $settings->get('logger.level'));
            $logger->pushHandler($handler);

            return $logger;
        },
        Redis::class => function (ContainerInterface $c): Redis {
            return RedisAdapter::createConnection(
                sprintf('redis://%s:%d', env('REDIS_NAME'), env('REDIS_PORT')),
                [
                    'compression' => true,
                    'lazy' => false,
                    'persistent' => 0,
                    'persistent_id' => null,
                    'tcp_keepalive' => 0,
                    'timeout' => 30,
                    'read_timeout' => 0,
                    'retry_interval' => 0,
                ]
            );
        },
    ]);
};
