<?php

declare(strict_types=1);

namespace App\Domain\Model\Room\Factories;

use App\Domain\Model\Room\Entities\Room;
use App\Domain\Model\User\Entities\Player;
use Ramsey\Uuid\Uuid;

/**
 * @package App\Domain\Model\Room\Factories
 */
class RoomFactory
{
    /**
     * @param Player $player
     * @return Room
     */
    public function initialize(Player $player): Room
    {
        return new Room(
            Uuid::uuid4(),
            collect($player)
        );
    }
}
