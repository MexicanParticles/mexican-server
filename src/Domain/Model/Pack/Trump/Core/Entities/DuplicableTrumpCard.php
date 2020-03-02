<?php declare(strict_types=1);

namespace App\Domain\Model\Pack\Trump\Core\Entities;

use App\Domain\Model\Card\Attribute\Core\ValueObjects\Rank;
use App\Domain\Model\Card\Attribute\Core\ValueObjects\Suit;
use App\Domain\Model\Card\Interfaces\Card;

/**
 * @package App\Domain\Model\Pack\Trump\Core\Entities
 */
class DuplicableTrumpCard implements Card
{
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
    public function __construct(Suit $suit, Rank $rank)
    {
        $this->suit = $suit;
        $this->rank = $rank;
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
}
