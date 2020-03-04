<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Room\Create\Inputs;

/**
 * @package App\Domain\UseCase\Room\Create\Inputs
 */
interface CreateRoomInputDataInterface
{
    /**
     * @return string
     */
    public function getUserName(): string;
}
