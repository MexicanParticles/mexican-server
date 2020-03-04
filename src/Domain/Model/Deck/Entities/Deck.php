<?php declare(strict_types=1);

namespace App\Domain\Model\Deck\Entities;

use App\Domain\Model\Card\Interfaces\Card;
use Illuminate\Support\Collection;

/**
 * @package App\Domain\Model\Deck\Entities
 */
class Deck
{
    /**
     * @var Collection<Card>
     */
    private Collection $deck;

    /**
     * @param Collection<Card> $deck
     */
    public function __construct(Collection $deck)
    {
        $this->deck = $deck;
    }

    /**
     * Shuttle deck.
     */
    final public function shuffle(): void
    {
        $this->deck->shuffle();
    }

    /**
     * Draw card from deck.
     * @return Card
     */
    final public function draw(): Card
    {
        return $this->deck->pop();
    }

    /**
     * @return bool
     */
    final public function isEmpty(): bool
    {
        return $this->deck->isEmpty();
    }
}
