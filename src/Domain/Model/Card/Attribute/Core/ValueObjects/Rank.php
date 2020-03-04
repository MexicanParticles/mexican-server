<?php declare(strict_types=1);

namespace App\Domain\Model\Card\Attribute\Core\ValueObjects;

/**
 * The number assigned to the card. This Class is implemented in Multiton.
 * @package App\Domain\Model\Card\Attribute\ValueObjects
 */
final class Rank
{
    /**
     * @var self[]
     */
    private static array $instances = [];

    /**
     * @var int
     */
    private int $number;

    /**
     * @param int $number
     */
    final private function __construct(int $number)
    {
        $this->number = $number;
    }

    /**
     * @param int $number
     * @return self
     */
    final public static function getInstance(int $number): self
    {
        if (array_key_exists($number, self::$instances)) {
            return self::$instances[$number];
        };

        $instance = new static($number);
        self::$instances[$number] = $instance;

        return $instance;
    }

    /**
     * @return int
     */
    final public function value(): int
    {
        return $this->number;
    }

    /**
     * Forbid clone in order to satisfy Multiton.
     */
    final private function __clone()
    {
    }
}
