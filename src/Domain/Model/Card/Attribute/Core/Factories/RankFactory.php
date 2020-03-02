<?php declare(strict_types=1);

namespace App\Domain\Model\Card\Attribute\Core\Factories;

use App\Domain\Model\Card\Attribute\Core\ValueObjects\Rank;
use Illuminate\Support\Collection;

/**
 * @package App\Domain\Model\Card\Attribute\Factories
 */
final class RankFactory
{
    /**
     * @param Rank $start
     * @param Rank $end
     * @return Collection<Rank>
     */
    final public function createCollection(Rank $start, Rank $end): Collection
    {
        return collect(range($start->value(), $end->value()))
            ->map(function (int $number): Rank {
                return Rank::getInstance($number);
            });
    }
}
