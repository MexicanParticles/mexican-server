<?php declare(strict_types=1);

namespace App\Domain\UseCase\User\ViewUser\Inputs;

interface ViewUserInputDataInterface
{
    /**
     * @return int
     */
    public function getUserId(): int;
}
