<?php

declare(strict_types=1);

namespace App\Domain\Model\User\Entities;

use App\Domain\Model\Card\Interfaces\Card;
use Illuminate\Support\Collection;
use JsonSerializable;
use Ramsey\Uuid\UuidInterface;

/**
 * @package App\Domain\Model\User\Entities
 */
class Player implements JsonSerializable
{
    /**
     * @var UuidInterface
     */
    private UuidInterface $UuidInterface;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var Collection<Card>
     */
    private Collection $hand;

    /**
     * @param UuidInterface    $UuidInterface
     * @param string           $name
     * @param Collection<Card> $hand
     */
    public function __construct(UuidInterface $UuidInterface, string $name, Collection $hand)
    {
        $this->UuidInterface = $UuidInterface;
        $this->name = $name;
        $this->hand = $hand;
    }

    /**
     * @return UuidInterface
     */
    public function getUuidInterface(): UuidInterface
    {
        return $this->UuidInterface;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Collection
     */
    public function getHand(): Collection
    {
        return $this->hand;
    }

    /**
     * {@inheritDoc}
     * @return mixed[]
     */
    public function jsonSerialize(): array
    {
        return [
            'UuidInterface' => $this->getUuidInterface()->toString(),
            'name' => $this->getName(),
            'hand' => $this->getHand()->all(),
        ];
    }
}
