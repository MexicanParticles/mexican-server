<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\UseCase\User\DataAccessInterfaces\UserRepository;
use App\Domain\UseCase\User\Exceptions\UserNotFoundException;
use App\Domain\Model\User\Entities\User;
use Illuminate\Support\Collection;

class InMemoryUserRepository implements UserRepository
{
    /**
     * @var User[]
     */
    private $users;

    /**
     * InMemoryUserRepository constructor.
     *
     * @param array|null $users
     */
    public function __construct(array $users = null)
    {
        $this->users = $users ?? [
                1 => new User(1, 'bill.gates', 'Bill', 'Gates'),
                2 => new User(2, 'steve.jobs', 'Steve', 'Jobs'),
                3 => new User(3, 'mark.zuckerberg', 'Mark', 'Zuckerberg'),
                4 => new User(4, 'evan.spiegel', 'Evan', 'Spiegel'),
                5 => new User(5, 'jack.dorsey', 'Jack', 'Dorsey'),
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): Collection
    {
        return collect($this->users)->values();
    }

    /**
     * {@inheritdoc}
     */
    public function findUserById(int $id): User
    {
        if (!isset($this->users[$id])) {
            throw new UserNotFoundException();
        }

        return $this->users[$id];
    }
}
