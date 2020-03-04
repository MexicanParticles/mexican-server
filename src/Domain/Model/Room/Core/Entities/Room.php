<?php

declare(strict_types=1);

namespace App\Domain\Model\Room\Entities;

use App\Domain\Model\User\Entities\Player;
use Illuminate\Support\Collection;
use JsonSerializable;
use Ramsey\Uuid\UuidInterface;

/**
 * @package App\Domain\Model\Room\Entities
 */
class Room implements JsonSerializable
{
    /**
     * @var UuidInterface
     */
    private UuidInterface $roomId;

    /**
     * @var Collection<Player>
     */
    private Collection $userCollection;

    /**
     * @param UuidInterface $roomId
     * @param Collection    $userCollection
     */
    public function __construct(UuidInterface $roomId, Collection $userCollection)
    {
        assert($userCollection->isNotEmpty());
        $this->roomId = $roomId;
        $this->userCollection = $userCollection;
    }

    /**
     * @return UuidInterface
     */
    public function getRoomId(): UuidInterface
    {
        return $this->roomId;
    }

    /**
     * @return Collection
     */
    public function getUserCollection(): Collection
    {
        return $this->userCollection;
    }

    /**
     * {@inheritDoc}
     * @return mixed[]
     */
    public function jsonSerialize(): array
    {
        return [
            'roomId' => $this->getRoomId()->toString(),
            'userList' => $this->getUserCollection()->all(),
        ];
    }
}
