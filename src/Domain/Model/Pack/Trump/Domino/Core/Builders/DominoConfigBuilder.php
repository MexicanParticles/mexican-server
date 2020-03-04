<?php declare(strict_types=1);

namespace App\Domain\Model\Pack\Trump\Domino\Core\Builders;

use App\Domain\Model\Card\Attribute\Core\ValueObjects\Rank;
use App\Domain\Model\Pack\Trump\Core\Builders\TrumpConfigBuilder;
use App\Domain\Model\Pack\Trump\Domino\Core\ValueObjects\DominoConfig;
use App\Utils\BuildableTrait;

/**
 * @packase App\Domain\Model\Pack\Trump\Domino\Core\Builders
 */
class DominoConfigBuilder extends TrumpConfigBuilder
{
    use BuildableTrait;

    /**
     * @var int|null
     */
    private ?int $baseOfRank;

    /**
     * @var bool|null
     */
    private ?bool $isRankRotatable;

    /**
     * @param int $baseOfRank
     * @return self
     */
    final public function setBaseOfRank(int $baseOfRank): self
    {
        return $this->set('baseOfRank', $baseOfRank);
    }

    /**
     * @param bool $isRankRotatable
     * @return self
     */
    final public function setIsRankRotatable(bool $isRankRotatable): self
    {
        return $this->set('isRankRotatable', $isRankRotatable);
    }

    /**
     * {@inheritDoc}
     * @return DominoConfig
     */
    protected function build(): DominoConfig
    {
        $baseOfRank = $this->baseOfRank ?? $this->config->get('trump.domino.baseOfRank');
        assert(is_int($baseOfRank));

        $trumpBuilder = parent::build();
        return new DominoConfig(
            $trumpBuilder,
            Rank::getInstance($baseOfRank),
            $this->isRankRotatable ?? $this->config->get('trump.domino.isRankRotatable')
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function initialize(): void
    {
        parent::initialize();
        $this->baseOfRank = null;
        $this->isRankRotatable = null;
    }
}
