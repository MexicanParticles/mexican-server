<?php

declare(strict_types=1);

namespace Tests\Application\Actions\User;

use App\Application\Actions\ActionPayload;
use App\Domain\Model\User\Entities\User;
use App\Domain\UseCase\User\DataAccessInterfaces\UserRepository;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use DI\Container;
use Tests\TestCase;

class ListUserActionTest extends TestCase
{
    public function testAction(): void
    {
        $app = $this->getAppInstance();

        $container = $app->getContainer();
        assert($container instanceof Container);

        $user = new User(1, 'bill.gates', 'Bill', 'Gates');

        $userCollection = collect([$user]);
        $userRepositoryProphecy = $this->prophesize(UserRepository::class);
        $userRepositoryProphecy
            ->findAll()
            ->willReturn($userCollection)
            ->shouldBeCalledOnce();

        $container->set(InMemoryUserRepository::class, $userRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/users');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(200, $userCollection);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        self::assertEquals($serializedPayload, $payload);
    }
}
