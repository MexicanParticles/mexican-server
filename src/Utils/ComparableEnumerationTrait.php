<?php declare(strict_types=1);

namespace App\Utils;

use Eloquent\Enumeration\AbstractMultiton;
use Illuminate\Support\Str;

/**
 * @method static AbstractMultiton memberByKey(string $key, bool $isCaseSensitive)
 */
trait ComparableEnumerationTrait
{
    /**
     * @param string $name
     * @param array $arguments unused
     * @return bool
     */
    final public function __call(string $name, array $arguments = []): bool
    {
        preg_match('/^is(.*)$/', $name, $matches, PREG_OFFSET_CAPTURE);
        assert([] !== $matches, sprintf('Function %s is not matching pattern /^is(.*)$/.', $name));
        return self::memberByKey(Str::snake($matches[1][0]), false) === $this;
    }
}
