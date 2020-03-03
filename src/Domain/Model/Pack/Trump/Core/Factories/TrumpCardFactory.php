<?php declare(strict_types=1);

namespace App\Domain\Model\Pack\Trump\Core\Factories;

use App\Domain\Model\Card\Attribute\Core\Factories\RankFactory;
use App\Domain\Model\Card\Attribute\Core\ValueObjects\Rank;
use App\Domain\Model\Card\Attribute\Core\ValueObjects\Suit;
use App\Domain\Model\Pack\Trump\Core\Entities\TrumpCard;
use App\Domain\Model\Pack\Trump\Core\ValueObjects\TrumpConfig;
use Illuminate\Support\Collection;

/**
 * @package App\Domain\Model\Pack\Trump\Core\Factories
 */
class TrumpCardFactory
{
    /**
     * @var RankFactory
     */
    private RankFactory $rankFactory;

    /**
     * @param RankFactory $rankFactory
     */
    public function __construct(
        RankFactory $rankFactory
    ) {
        $this->rankFactory = $rankFactory;
    }

    /**
     * @param Suit $suit
     * @param Rank $rank
     * @return TrumpCard
     */
    public function create(Suit $suit, Rank $rank): TrumpCard
    {
        return TrumpCard::getInstance($suit, $rank);
    }

    /**
     * @param string $suit
     * @param int $rank
     * @return TrumpCard
     */
    public function createFromValue(string $suit, int $rank): TrumpCard
    {
        return $this->create(
            Suit::memberByValue($suit),
            Rank::getInstance($rank)
        );
    }

    /**
     * @param TrumpConfig $trumpConfig
     * @return Collection<TrumpCard>
     */
    public function createCollection(TrumpConfig $trumpConfig): Collection
    {
        return $this
            ->rankFactory
            ->createCollection($trumpConfig->getStartOfRank(), $trumpConfig->getEndOfRank())
            ->crossJoin($trumpConfig->getSuitCollection())
            ->map(function (array $arr): TrumpCard {
                return $this->create(... $arr);
            });
    }
}
