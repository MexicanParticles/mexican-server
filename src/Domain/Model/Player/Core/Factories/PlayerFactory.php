<?php

declare(strict_types=1);

namespace App\Domain\Model\Room\Factories;

use App\Domain\Model\User\Entities\Player;
use Ramsey\Uuid\Uuid;

/**
 * @package App\Domain\Model\Room\Factories
 */
class PlayerFactory
{
    /**
     * @param string $name
     * @return Player
     */
    public function initialize(string $name): Player
    {
        return new Player(
            Uuid::uuid4(),
            $name,
            collect()
        );
    }
}
