<?php declare(strict_types=1);

namespace App\Domain\Model\Pack\Trump\Core\Builders;

use App\Domain\Model\Card\Attribute\Core\ValueObjects\Rank;
use App\Domain\Model\Card\Attribute\Core\ValueObjects\Suit;
use App\Domain\Model\Pack\Trump\Core\Interfaces\TrumpConfigInterface;
use App\Domain\Model\Pack\Trump\Core\ValueObjects\TrumpConfig;
use App\Utils\BuildableTrait;
use App\Utils\AbstractInitializableBuilderTrait;
use Illuminate\Config\Repository;
use Illuminate\Support\Collection;

/**
 * @packase App\Domain\Model\Pack\Trump\Core\Builders;
 */
class TrumpConfigBuilder
{
    use AbstractInitializableBuilderTrait;
    use BuildableTrait;

    /**
     * @var Repository
     */
    protected Repository $config;

    /**
     * @var int|null
     */
    private ?int $numOfJoker;

    /**
     * @var int|null
     */
    private ?int $startOfRank;

    /**
     * @var int|null
     */
    private ?int $endOfRank;

    /**
     * @var Collection<Suit>|null
     */
    private ?Collection $suitCollection;

    /**
     * @param Repository $config
     */
    final public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * @param int $numOfJoker
     * @return self
     */
    final public function setNumberOfJokers(int $numOfJoker): self
    {
        return $this->set('numOfJoker', $numOfJoker);
    }

    /**
     * @param int $startOfRank
     * @return self
     */
    final public function setStartOfRank(int $startOfRank): self
    {
        return $this->set('startOfRank', $startOfRank);
    }

    /**
     * @param int $endOfRank
     * @return self
     */
    final public function setEndOfRank(int $endOfRank): self
    {
        return $this->set('endOfRank', $endOfRank);
    }

    /**
     * @param Collection<Suit> $suitCollection
     * @return self
     */
    final public function setSuitList(Collection $suitCollection): self
    {
        return $this->set('suitCollection', $suitCollection);
    }

    /**
     * {@inheritDoc}
     * @return TrumpConfigInterface
     */
    protected function build(): TrumpConfigInterface
    {
        $rankStart = $this->startOfRank ?? $this->config->get('trump.rank.start');
        $rankEnd = $this->endOfRank ?? $this->config->get('trump.rank.end');
        assert(is_int($rankStart) && is_int($rankEnd));

        return new TrumpConfig(
            $this->numOfJoker ?? $this->config->get('trump.numOfJoker'),
            Rank::getInstance($rankStart),
            Rank::getInstance($rankEnd),
            $this->suitCollection ?? $this->config->get('trump.suit')
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function initialize(): void
    {
        $this->numOfJoker = null;
        $this->startOfRank = null;
        $this->endOfRank = null;
        $this->suitCollection = null;
    }
}
