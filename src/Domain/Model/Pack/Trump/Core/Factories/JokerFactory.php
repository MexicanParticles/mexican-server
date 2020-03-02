<?php declare(strict_types=1);

namespace App\Domain\Model\Pack\Trump\Core\Factories;

use App\Domain\Model\Card\Attribute\Core\ValueObjects\Rank;
use App\Domain\Model\Card\Attribute\Core\ValueObjects\Suit;
use App\Domain\Model\Pack\Trump\Core\Entities\TrumpCard;
use App\Domain\Model\Pack\Trump\Core\ValueObjects\TrumpConfig;
use Illuminate\Support\Collection;

/**
 * @package App\Domain\Model\Pack\Trump\Core\Factories
 */
final class JokerFactory
{
    /**
     * @param TrumpConfig $trumpConfig
     * @return Collection<TrumpCard>
     */
    final public function createCollection(TrumpConfig $trumpConfig): Collection
    {
        return Collection::times($trumpConfig->getNumOfJoker(), function (int $time): TrumpCard {
            return TrumpCard::getInstance(Suit::JOKER(), Rank::getInstance($time));
        });
    }
}
