<?php

declare(strict_types=1);

namespace App\Domain\UseCase\User\DataAccessInterfaces;

use App\Domain\UseCase\User\Exceptions\UserNotFoundException;
use App\Domain\Model\User\Entities\User;
use Illuminate\Support\Collection;

interface UserRepository
{
    /**
     * @return Collection<User>
     */
    public function findAll(): Collection;

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserById(int $id): User;
}
