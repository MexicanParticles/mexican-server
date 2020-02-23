<?php

declare(strict_types=1);

namespace Tests\Utils;

use App\Utils\CommandInvoker;
use DI\Container;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Tests\Resources\Commands\CommandA;
use Tests\Resources\Commands\CommandB;
use Tests\Resources\Commands\NoCommand;

/**
 * @package Tests\Utils
 * @coversDefaultClass \App\Utils\CommandInvoker
 */
class CommandInvokerTest extends TestCase
{
    private $invoker;
    private $container;
    private $console;
    private $output;

    /**
     * {@inheritDoc}
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->container = $this->prophesize(Container::class);
        $this->console = $this->prophesize(Application::class);
        $this->output = $this->prophesize(ConsoleOutputInterface::class);
        $this->invoker = new CommandInvoker(
            $this->container->reveal(),
            $this->console->reveal(),
            $this->output->reveal()
        );
    }

    /**
     * @covers ::__invoke
     */
    public function testInvoke(): void
    {
        $this
            ->container
            ->getKnownEntryNames()
            ->willReturn([
                CommandInvoker::class,
                TestCase::class,
                Container::class,
                Application::class,
                ConsoleOutputInterface::class,
                CommandA::class,
                CommandB::class,
                NoCommand::class,
            ])
            ->shouldBeCalled();

        $this
            ->container
            ->get(CommandA::class)
            ->willReturn($commandA = new CommandA())
            ->shouldBeCalled();
        $this
            ->container
            ->get(CommandB::class)
            ->willReturn($commandB = new CommandB())
            ->shouldBeCalled();

        $this
            ->console
            ->addCommands([$commandA, $commandB])
            ->shouldBeCalled();

        $this
            ->console
            ->run(null, $this->output->reveal())
            ->shouldBeCalled();

        $this->invoker->__invoke('Tests\Resources\Commands');
    }
}
