<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Persistence\User;

use App\Domain\Model\User\Entities\User;
use App\Domain\UseCase\User\Exceptions\UserNotFoundException;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use Tests\TestCase;

class InMemoryUserRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $user = new User(1, 'bill.gates', 'Bill', 'Gates');

        $userList = [1 => $user];
        $userRepository = new InMemoryUserRepository($userList);

        self::assertEquals(collect([$user]), $userRepository->findAll());
    }

    public function testFindUserOfId(): void
    {
        $user = new User(1, 'bill.gates', 'Bill', 'Gates');

        $userRepository = new InMemoryUserRepository([1 => $user]);

        self::assertEquals($user, $userRepository->findUserById(1));
    }

    public function testFindUserOfIdThrowsNotFoundException(): void
    {
        $this->expectException(UserNotFoundException::class);
        $userRepository = new InMemoryUserRepository([]);
        $userRepository->findUserById(1);
    }
}
