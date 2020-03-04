<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Room\Create\Outputs;

use App\Domain\Model\Room\Entities\Room;

/**
 * @package App\Domain\UseCase\Room\Create\Outputs
 */
class CreateRoomOutputData
{
    /**
     * @var Room
     */
    private Room $userCollection;

    /**
     * @param Room $userCollection
     */
    public function __construct(Room $userCollection)
    {
        $this->userCollection = $userCollection;
    }
}
