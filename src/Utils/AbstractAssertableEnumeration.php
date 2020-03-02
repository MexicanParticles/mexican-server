<?php declare(strict_types=1);

namespace App\Utils;

use Eloquent\Enumeration\AbstractValueMultiton;
use Eloquent\Enumeration\EnumerationInterface;
use Eloquent\Enumeration\Exception\ExtendsConcreteException;
use ReflectionException;
use ReflectionClass;

/**
 * @package App\Utils
 * @see \Eloquent\Enumeration\AbstractEnumeration
 * @license https://github.com/eloquent/enumeration/blob/master/LICENSE
 */
abstract class AbstractAssertableEnumeration extends AbstractValueMultiton implements EnumerationInterface
{
    /**
     * {@inheritDoc}
     * @throws ExtendsConcreteException|ReflectionException
     */
    final protected static function initializeMembers(): void
    {
        $reflector = new ReflectionClass(get_called_class());

        foreach ($reflector->getReflectionConstants() as $constant) {
            if ($constant->isPublic()) {
                static::assertForName($constant->getName());
                static::assertForValue($constant->getValue());
                new static($constant->getName(), $constant->getValue());
            }
        }
    }

    /**
     * Assert for names of constants.
     * @param string $name
     */
    protected static function assertForName(string $name): void
    {
    }

    /**
     * Assert for values of constants.
     * @param mixed $value
     */
    protected static function assertForValue($value): void
    {
    }
}
