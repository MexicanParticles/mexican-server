<?php

declare(strict_types=1);

namespace App\Utils;

use DI\Container;
use Exception;
use ReflectionClass;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\ConsoleOutputInterface;

/**
 * @package App\Utils
 */
class CommandInvoker
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @var Application
     */
    private $console;

    /**
     * @var ConsoleOutputInterface
     */
    private $output;

    /**
     * @param Container              $container
     * @param Application            $console
     * @param ConsoleOutputInterface $output
     */
    public function __construct(
        Container $container,
        Application $console,
        ConsoleOutputInterface $output
    ) {
        $this->container = $container;
        $this->console = $console;
        $this->output = $output;
    }

    /**
     * @param string $namespace
     * @throws Exception
     */
    public function __invoke(string $namespace): void
    {
        $commandList = collect($this->container->getKnownEntryNames())
            ->filter(function (string $class) use ($namespace): bool {
                return 0 === strpos($class, $namespace);
            })
            ->map(function (string $class): ReflectionClass {
                return new ReflectionClass($class);
            })
            ->filter(function (ReflectionClass $class): bool {
                return $this->isParentCommand($class);
            })
            ->map(function (ReflectionClass $class): Command {
                return $this->container->get($class->getName());
            })
            ->values()
            ->all();
        $this->console->addCommands($commandList);
        $this->console->run(null, $this->output);
    }

    /**
     * @param ReflectionClass $class
     * @return bool
     */
    private function isParentCommand(ReflectionClass $class): bool
    {
        $parent = $class->getParentClass();
        if (false === $parent) {
            return false;
        }
        if (Command::class === $parent->getName()) {
            return true;
        }
        return $this->isParentCommand($parent);
    }
}
