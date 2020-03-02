<?php declare(strict_types=1);

namespace App\Domain\Model\Pack\Trump\Domino\Core\ValueObjects;

use App\Domain\Model\Card\Attribute\Core\ValueObjects\Rank;
use App\Domain\Model\Pack\Trump\Core\Interfaces\TrumpConfigInterface;
use App\Domain\Model\Pack\Trump\Core\ValueObjects\TrumpConfigDecorator;

/**
 * @package App\Domain\Model\Pack\Trump\Domino\Core\ValueObjects
 */
class DominoConfig extends TrumpConfigDecorator
{
    /**
     * @var Rank
     */
    private Rank $baseOfRank;

    /**
     * @var bool
     */
    private bool $isRankRotatable;

    /**
     * @param TrumpConfigInterface $trumpConfig
     * @param Rank $baseOfRank
     * @param bool $isRankRotatable
     */
    public function __construct(
        TrumpConfigInterface $trumpConfig,
        Rank $baseOfRank,
        bool $isRankRotatable
    ) {
        parent::__construct($trumpConfig);
        $this->baseOfRank = $baseOfRank;
        $this->isRankRotatable = $isRankRotatable;
    }

    /**
     * @return Rank
     */
    final public function getBaseOfRank(): Rank
    {
        return $this->baseOfRank;
    }

    /**
     * @param Rank $rank
     * @return bool
     */
    final public function isBaseOfRankEqualTo(Rank $rank): bool
    {
        return $this->baseOfRank === $rank;
    }

    /**
     * @return bool
     */
    final public function isRankRotatable(): bool
    {
        return $this->isRankRotatable;
    }
}
