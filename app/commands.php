<?php declare(strict_types=1);

use App\Commands\SampleCommand;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder): void {
    $containerBuilder->addDefinitions([
        SampleCommand::class => function (): SampleCommand {
            return new SampleCommand(SampleCommand::class);
        }
    ]);
};
