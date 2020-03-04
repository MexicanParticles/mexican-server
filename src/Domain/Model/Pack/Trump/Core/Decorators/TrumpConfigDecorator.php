<?php declare(strict_types=1);

namespace App\Domain\Model\Pack\Trump\Core\Decorators;

use App\Domain\Model\Card\Attribute\Core\ValueObjects\Rank;
use App\Domain\Model\Card\Attribute\Core\ValueObjects\Suit;
use App\Domain\Model\Pack\Trump\Core\Interfaces\TrumpConfigInterface;
use Illuminate\Support\Collection;

/**
 * @package App\Domain\Model\Pack\Trump\Core\ValueObjects
 */
abstract class TrumpConfigDecorator implements TrumpConfigInterface
{
    /**
     * @var TrumpConfigInterface
     */
    private TrumpConfigInterface $trumpConfig;

    /**
     * @param TrumpConfigInterface $trumpConfig
     */
    public function __construct(TrumpConfigInterface $trumpConfig)
    {
        $this->trumpConfig = $trumpConfig;
    }

    /**
     * @return int
     */
    final public function getNumOfJoker(): int
    {
        return $this->trumpConfig->getNumOfJoker();
    }

    /**
     * @return Rank
     */
    final public function getStartOfRank(): Rank
    {
        return $this->trumpConfig->getStartOfRank();
    }

    /**
     * @return Rank
     */
    final public function getEndOfRank(): Rank
    {
        return $this->trumpConfig->getEndOfRank();
    }

    /**
     * @return Collection<Suit>
     */
    final public function getSuitCollection(): Collection
    {
        return $this->trumpConfig->getSuitCollection();
    }
}
