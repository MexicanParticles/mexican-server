<?php declare(strict_types=1);

namespace App\Domain\Model\Pack\Trump\Core\ValueObjects;

use App\Domain\Model\Card\Attribute\Core\ValueObjects\Rank;
use App\Domain\Model\Card\Attribute\Core\ValueObjects\Suit;
use App\Domain\Model\Pack\Trump\Core\Interfaces\TrumpConfigInterface;
use Illuminate\Support\Collection;

/**
 * @package App\Domain\Model\Pack\Trump\Core\ValueObjects
 */
final class TrumpConfig implements TrumpConfigInterface
{
    /**
     * @var int
     */
    private int $numOfJoker;

    /**
     * @var Rank
     */
    private Rank $startOfRank;

    /**
     * @var Rank
     */
    private Rank $endOfRank;

    /**
     * @var Collection<Suit>
     */
    private Collection $suitCollection;

    /**
     * @param int $numOfJoker
     * @param Rank $startOfRank
     * @param Rank $endOfRank
     * @param Collection<Suit> $suitCollection
     */
    final public function __construct(
        int $numOfJoker,
        Rank $startOfRank,
        Rank $endOfRank,
        Collection $suitCollection
    ) {
        $this->numOfJoker = $numOfJoker;
        $this->startOfRank = $startOfRank;
        $this->endOfRank = $endOfRank;
        $this->suitCollection = $suitCollection;
    }

    /**
     * @return int
     */
    final public function getNumOfJoker(): int
    {
        return $this->numOfJoker;
    }

    /**
     * @return Rank
     */
    final public function getStartOfRank(): Rank
    {
        return $this->startOfRank;
    }

    /**
     * @return Rank
     */
    final public function getEndOfRank(): Rank
    {
        return $this->endOfRank;
    }

    /**
     * @return Collection<Suit>
     */
    final public function getSuitCollection(): Collection
    {
        return $this->suitCollection;
    }
}
