<?php declare(strict_types=1);

namespace App\Domain\Model\Card\Attribute\Core\ValueObjects;

use App\Utils\AbstractAssertableEnumeration;
use App\Utils\ComparableEnumerationTrait;

/**
 * @package App\Domain\Model\Card\ValueObjects
 * @method static self JOKER()
 * @method static self HEARTS()
 * @method static self TILES()
 * @method static self CLOVERS()
 * @method static self PIKES()
 * @method bool isJoker()
 * @method bool isHearts()
 * @method bool isTiles()
 * @method bool isClovers()
 * @method bool isPikes()
 */
final class Suit extends AbstractAssertableEnumeration
{
    use ComparableEnumerationTrait;

    public const JOKER = 'JOKER';
    public const HEARTS = 'HEARTS';
    public const TILES = 'TILES';
    public const CLOVERS = 'CLOVERS';
    public const PIKES = 'PIKES';

    /**
     * {@inheritDoc}
     */
    final protected static function assertForValue($value): void
    {
        assert(is_string($value), 'Values of constants should be string.');
        assert(
            self::ensureIfOnlyConsistsOfWordChars((string) $value),
            'Values of constants should only consist of letters, numbers or underscores.'
        );
    }

    /**
     * @param string $haystack
     * @return bool
     */
    final private static function ensureIfOnlyConsistsOfWordChars(string $haystack): bool
    {
        preg_match('/^\w+$/', $haystack, $matches);
        return reset($matches) === $haystack;
    }
}
