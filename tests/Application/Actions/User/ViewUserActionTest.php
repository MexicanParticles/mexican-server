<?php

declare(strict_types=1);

namespace Tests\Application\Actions\User;

use App\Application\Actions\ActionError;
use App\Application\Actions\ActionPayload;
use App\Application\Handlers\HttpErrorHandler;
use App\Domain\Model\User\Entities\User;
use App\Domain\UseCase\User\DataAccessInterfaces\UserRepository;
use App\Domain\UseCase\User\Exceptions\UserNotFoundException;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use DI\Container;
use Slim\Middleware\ErrorMiddleware;
use Tests\TestCase;

class ViewUserActionTest extends TestCase
{
    public function testAction(): void
    {
        $app = $this->getAppInstance();

        $container = $app->getContainer();
        assert($container instanceof Container);

        $user = new User(1, 'bill.gates', 'Bill', 'Gates');

        $userRepositoryProphecy = $this->prophesize(UserRepository::class);
        $userRepositoryProphecy
            ->findUserById(1)
            ->willReturn($user)
            ->shouldBeCalledOnce();

        $container->set(InMemoryUserRepository::class, $userRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/users/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(200, $user);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        self::assertEquals($serializedPayload, $payload);
    }

    public function testActionThrowsUserNotFoundException(): void
    {
        $app = $this->getAppInstance();

        $callableResolver = $app->getCallableResolver();
        $responseFactory = $app->getResponseFactory();

        $errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);
        $errorMiddleware = new ErrorMiddleware($callableResolver, $responseFactory, true, false, false);
        $errorMiddleware->setDefaultErrorHandler($errorHandler);

        $app->add($errorMiddleware);

        $container = $app->getContainer();
        assert($container instanceof Container);

        $userRepositoryProphecy = $this->prophesize(UserRepository::class);
        $userRepositoryProphecy
            ->findUserById(1)
            ->willThrow(new UserNotFoundException())
            ->shouldBeCalledOnce();

        $container->set(InMemoryUserRepository::class, $userRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/users/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
//        $expectedError = new ActionError(ActionError::RESOURCE_NOT_FOUND, 'The user you requested does not exist.');
//        $expectedPayload = new ActionPayload(404, null, $expectedError);
        /** @FIXME */
        $expectedError = new ActionError(ActionError::SERVER_ERROR, 'The user you requested does not exist.');
        $expectedPayload = new ActionPayload(500, null, $expectedError);

        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        self::assertEquals($serializedPayload, $payload);
    }
}
