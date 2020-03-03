<?php

declare(strict_types=1);

namespace App\Domain\Model\User\Entities;

use App\Domain\Model\Card\Interfaces\Card;
use Illuminate\Support\Collection;
use JsonSerializable;
use Ramsey\Uuid\Uuid;

/**
 * @package App\Domain\Model\User\Entities
 */
class Player implements JsonSerializable
{
    /**
     * @var Uuid|null
     */
    private $uuid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Collection<Card>
     */
    private $hand;

    /**
     * @param Uuid|null        $uuid
     * @param string           $name
     * @param Collection<Card> $hand
     */
    public function __construct(?Uuid $uuid, string $name, Collection $hand)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->hand = $hand;
    }

    /**
     * @return Uuid|null
     */
    public function getUuid(): ?Uuid
    {
        return $this->uuid;
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
            'uuid' => $this->getUuid()->toString(),
            'name' => $this->getName(),
            'hand' => $this->getHand()->all(),
        ];
    }
}
