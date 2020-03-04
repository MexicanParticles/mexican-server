<?php declare(strict_types=1);

namespace App\Domain\Model\Pack\Trump\Core\Entities;

use App\Domain\Model\Card\Attribute\Core\ValueObjects\Rank;
use App\Domain\Model\Card\Attribute\Core\ValueObjects\Suit;
use App\Domain\Model\Card\Interfaces\Card;

/**
 * This class is implemented in Multiton because it is expected to use only one pack.
 * When using multiple packs, a different class must be used.
 * @package App\Domain\Model\Pack\Trump\Core\Entities
 */
class TrumpCard implements Card
{
    /**
     * @var self[]
     */
    private static array $instances = [];

    /**
     * @var Suit
     */
    private Suit $suit;

    /**
     * @var Rank
     */
    private Rank $rank;

    /**
     * @param Suit $suit
     * @param Rank $rank
     */
    private function __construct(Suit $suit, Rank $rank)
    {
        $this->suit = $suit;
        $this->rank = $rank;
    }

    /**
     * @param Suit $suit
     * @param Rank $rank
     * @return self
     */
    public static function getInstance(Suit $suit, Rank $rank): self
    {
        $key = sprintf('%s-%d', $suit->value(), $rank->value());
        if (array_key_exists($key, self::$instances)) {
            return self::$instances[$key];
        };

        $instance = new static($suit, $rank);
        self::$instances[$key] = $instance;

        return $instance;
    }

    /**
     * @return Suit
     */
    final public function getSuit(): Suit
    {
        return $this->suit;
    }

    /**
     * @return Rank
     */
    final public function getRank(): Rank
    {
        return $this->rank;
    }

    /**
     * Forbid clone in order to satisfy Multiton.
     */
    final private function __clone()
    {
    }
}
