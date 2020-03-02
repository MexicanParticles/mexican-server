<?php declare(strict_types=1);

namespace App\Domain\Model\Field\Trump\Domino\Core\Entities;

use App\Domain\Model\Card\Attribute\Core\ValueObjects\Rank;
use App\Domain\Model\Card\Attribute\Core\ValueObjects\Suit;
use App\Domain\Model\Field\Trump\Domino\Core\ValueObjects\DominoFieldState;
use App\Domain\Model\Pack\Trump\Domino\Core\ValueObjects\DominoConfig;

/**
 * @package App\Domain\Model\Field\Trump\Domino\Entities
 */
class DominoField
{
    /**
     * @var array [ suit => [ rank => DominoFieldState ]]
     */
    private array $field;

    /**
     * @param array $field [ suit => [ rank => DominoFieldState ]]
     */
    public function __construct(array $field)
    {
        $this->field = $field;
    }

    /**
     * @param Suit $suit
     * @param DominoConfig $config
     * @return Rank|null
     */
    final public function getSettableRankByAsc(Suit $suit, DominoConfig $config): ?Rank
    {
        $rankCollection = collect($this->field[$suit->value()])
            ->filter(function (DominoFieldState $state, int $rank) use ($config): bool {
                if (false === $state->isSettable()) {
                    return false;
                }
                if ($config->isRankRotatable()) {
                    return true;
                }
                return $config->getBaseOfRank() > $rank;
            })
            ->keys();

        $isThereBlankInGreaterThanBase = $rankCollection
            ->containsStrict(function (int $rank) use ($config): bool {
                return $config->getBaseOfRank() < $rank;
            });

        if ($isThereBlankInGreaterThanBase) {
            return $rankCollection
                ->filter(function (int $rank) use ($config): bool {
                    return $config->getBaseOfRank() > $rank;
                })
                ->min();
        }
        return $rankCollection->min();
    }

    /**
     * @param Suit $suit
     * @param DominoConfig $config
     * @return Rank|null
     */
    final public function getSettableRankByDesc(Suit $suit, DominoConfig $config): ?Rank
    {
        $rankCollection = collect($this->field[$suit->value()])
            ->filter(function (DominoFieldState $state, int $rank) use ($config): bool {
                if (false === $state->isSettable()) {
                    return false;
                }
                if ($config->isRankRotatable()) {
                    return true;
                }
                return $config->getBaseOfRank() < $rank;
            })
            ->keys();

        $isThereBlankInGreaterThanBase = $rankCollection
            ->containsStrict(function (int $rank) use ($config): bool {
                return $config->getBaseOfRank() < $rank;
            });

        if ($isThereBlankInGreaterThanBase) {
            return $rankCollection
                ->filter(function (int $rank) use ($config): bool {
                    return $config->getBaseOfRank() < $rank;
                })
                ->max();
        }
        return $rankCollection->max();
    }
}
