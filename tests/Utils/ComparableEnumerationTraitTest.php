<?php

declare(strict_types=1);

namespace Tests\Utils;

use App\Utils\ComparableEnumerationTrait;
use Eloquent\Enumeration\AbstractEnumeration;
use Error;
use PHPUnit\Framework\TestCase;
use Tests\Helper\AssertionTestableTrait;

/**
 * @package Tests\Utils
 * @coversDefaultClass \App\Utils\ComparableEnumerationTrait
 */
class ComparableEnumerationTraitTest extends TestCase
{
    use AssertionTestableTrait;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->setAssertionSetting();
        parent::setUp();
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->revertAssertionSetting();
        parent::tearDown();
    }

    public function testCall(): void
    {
        $foo = ConcreteComparableEnumeration::FOO();
        self::assertTrue($foo->isFoo());
        self:: assertFalse($foo->isBarBaz());

        $barBaz = ConcreteComparableEnumeration::BAR_BAZ();
        self::assertFalse($barBaz->isFoo());
        self::assertTrue($barBaz->isBarBaz());
    }

    public function testFail(): void
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('Function foo is not matching pattern /^is(.*)$/.');
        ConcreteComparableEnumeration::FOO()->foo();
    }
}

// @codingStandardsIgnoreStart
/**
 * As the constructor of AbstractEnumeration is protected, it can not call as anonymous class.
 * @method static self FOO()
 * @method static self BAR_BAZ()
 * @method bool isFoo()
 * @method bool isBarBaz()
 */
class ConcreteComparableEnumeration extends AbstractEnumeration
{
    use ComparableEnumerationTrait;

    public const FOO = 0;
    public const BAR_BAZ = 1;
}
// @codingStandardsIgnoreEnd
