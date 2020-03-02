<?php declare(strict_types=1);

namespace App\Domain\Model\Pack\Trump\Core\Interfaces;

use App\Domain\Model\Card\Attribute\Core\ValueObjects\Rank;
use App\Domain\Model\Card\Attribute\Core\ValueObjects\Suit;
use Illuminate\Support\Collection;

/**
 * @package App\Domain\Model\Pack\Trump\Core\Interfaces
 */
interface TrumpConfigInterface
{
    /**
     * @return int
     */
    public function getNumOfJoker(): int;

    /**
     * @return Rank
     */
    public function getStartOfRank(): Rank;

    /**
     * @return Rank
     */
    public function getEndOfRank(): Rank;

    /**
     * @return Collection<Suit>
     */
    public function getSuitCollection(): Collection;
}
