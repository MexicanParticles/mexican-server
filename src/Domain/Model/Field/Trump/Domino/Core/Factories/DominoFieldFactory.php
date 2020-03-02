<?php declare(strict_types=1);

namespace App\Domain\Model\Field\Trump\Domino\Core\Factories;

use App\Domain\Model\Deck\Entities\Deck;
use App\Domain\Model\Field\Trump\Domino\Core\Entities\DominoField;
use App\Domain\Model\Field\Trump\Domino\Core\ValueObjects\DominoFieldState;
use App\Domain\Model\Pack\Trump\Core\Entities\TrumpCard;
use App\Domain\Model\Pack\Trump\Domino\Core\ValueObjects\DominoConfig;

/**
 * @package App\Domain\Model\Field\Trump\Domino\Factories
 */
final class DominoFieldFactory
{
    /**
     * @param DominoConfig $config
     * @param Deck $deck
     * @return DominoField
     */
    final public function create(DominoConfig $config, Deck $deck): DominoField
    {
        $field = [];
        $cloned = clone $deck;

        while (false === $cloned->isEmpty()) {
            $card = $cloned->draw();
            assert($card instanceof TrumpCard, 'Deck for trump dominos should only consist of TrumpCard');

            if ($card->getSuit()->isJoker()) {
                continue;
            }
            $state = $config->isBaseOfRankEqualTo($card->getRank()) ? DominoFieldState::SET(): DominoFieldState::BLANK();
            $field[$card->getSuit()->value()][] = [$card->getRank()->value() => $state];
        }

        return new DominoField($field);
    }
}

