<?php

namespace Tests\Domain\Card\Attribute;

use App\Domain\Model\Card\Attribute\ValueObjects\Suit;
use PHPUnit\Framework\TestCase;

class SuitTest extends TestCase
{
    public function testPublicMethods(): void
    {
        self::assertSame(Suit::JOKER, Suit::JOKER()->value());
        self::assertSame(Suit::HEARTS, Suit::HEARTS()->value());
        self::assertSame(Suit::TILES, Suit::TILES()->value());
        self::assertSame(Suit::CLOVERS, Suit::CLOVERS()->value());
        self::assertSame(Suit::PIKES, Suit::PIKES()->value());
    }

    public function testNoConstantWithTheSameValueExists(): void
    {
        $uniqueCount = collect(Suit::members())
            ->map->value()
            ->values()
            ->unique()
            ->count();

        self::assertCount($uniqueCount, Suit::members());
    }
}
