<?php declare(strict_types=1);

namespace Tests\Application\Commands;

use App\Application\Commands\SampleCommand;
use App\Utils\CommandRunnableTrait;
use Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Tester\TesterTrait;

/**
 * @package Tests\Commands
 * @coversDefaultClass \App\Application\Commands\SampleCommand
 */
class SampleCommandTest extends TestCase
{
    use CommandRunnableTrait;
    use TesterTrait;

    protected function setUp()
    {
        parent::setUp();
        $this->initOutput([]);
    }

    /**
     * @covers ::execute
     * @throws Exception
     */
    public function testExecute(): void
    {
        $this->runCommand(
            new SampleCommand(),
            new ArrayInput(['command' => 'sample:test']),
            $this->output
        );
        $aaa = $this->getDisplay();

        self::assertSame("Done\n", $aaa);
    }
}
