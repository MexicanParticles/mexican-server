<?php declare(strict_types=1);

namespace App\Utils;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Exception;

/**
 * @package App\Utils
 */
trait CommandRunnableTrait
{
    /**
     * @param Command $command
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     */
    public function runCommand(
        Command $command,
        InputInterface $input,
        OutputInterface $output
    ): int  {
        $application = new class() extends Application {};

        $application->add($command);
        $application->setAutoExit(false);
        $application->setCatchExceptions(false);

        return $application->run($input, $output);
    }
}
