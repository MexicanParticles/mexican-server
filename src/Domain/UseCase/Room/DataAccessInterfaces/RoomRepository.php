<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Room\DataAccessInterfaces;

use App\Domain\Model\Room\Entities\Room;

/**
 * @package App\Domain\UseCase\Room\DataAccessInterfaces
 */
interface RoomRepository
{
    /**
     * @param Room $room
     */
    public function save(Room $room): void;
}
