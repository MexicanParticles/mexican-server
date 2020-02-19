<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Illuminate\Config\Repository;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder): void {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => new Repository([
            'displayErrorDetails' => true, // Should be set to false in production
            'logger' => [
                'name' => 'slim-app',
                'path' => '/../logs/app.log',
                'level' => Logger::DEBUG,
            ],
        ]),
    ]);
};
