<?php declare(strict_types=1);

namespace App\Domain\Model\Pack\Trump\Core\Factories;

use App\Domain\Model\Deck\Entities\Deck;
use App\Domain\Model\Pack\Trump\Core\Entities\TrumpCard;
use App\Domain\Model\Pack\Trump\Core\ValueObjects\TrumpConfig;

/**
 * @package App\Domain\Model\Pack\Trump\Core\Factories
 */
class TrumpDeckFactory
{
    /**
     * @var TrumpCardFactory
     */
    private TrumpCardFactory $trumpCardFactory;

    /**
     * @var JokerFactory
     */
    private JokerFactory $jokerFactory;

    /**
     * @param TrumpCardFactory $trumpCardFactory
     * @param JokerFactory     $jokerFactory
     */
    public function __construct(
        TrumpCardFactory $trumpCardFactory,
        JokerFactory $jokerFactory
    ) {
        $this->trumpCardFactory = $trumpCardFactory;
        $this->jokerFactory = $jokerFactory;
    }

    /**
     * @param TrumpCard $card
     * @return bool
     */
    public function rejectFromDeck(TrumpCard $card): bool
    {
        return false;
    }

    /**
     * @param TrumpConfig $config
     * @return Deck
     */
    public function createDeck(TrumpConfig $config): Deck
    {
        $jokerCollection = $this
            ->jokerFactory
            ->createCollection($config);

        $trumpCollection = $this
            ->trumpCardFactory
            ->createCollection($config)
            ->merge($jokerCollection)
            ->reject(function (TrumpCard $trumpCard) {
                return $this->rejectFromDeck($trumpCard);
            });

        return new Deck($trumpCollection);
    }
}
