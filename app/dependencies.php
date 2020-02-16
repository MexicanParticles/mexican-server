<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\RedisAdapter;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c): LoggerInterface {
            $settings = $c->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
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
