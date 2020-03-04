<?php declare(strict_types=1);

namespace App\Domain\Model\Field\Trump\Domino\Core\ValueObjects;

use App\Utils\ComparableEnumerationTrait;
use Eloquent\Enumeration\AbstractEnumeration;

/**
 * @package App\Domain\Model\Field\Trump\Domino\ValueObjects
 * @method static self BLANK()
 * @method static self SET()
 * @method static self JOKER()
 * @method bool isBlank()
 * @method bool isSet()
 * @method bool isJoker()
 */
final class DominoFieldState extends AbstractEnumeration
{
    use ComparableEnumerationTrait;

    /**
     * @var int
     */
    public const BLANK = 0;

    /**
     * @var int
     */
    public const SET = 1;

    /**
     * @var int
     */
    public const JOKER = 2;

    /**
     * @return bool
     */
    final public function isSettable(): bool
    {
        return false === $this->isSet();
    }
}
