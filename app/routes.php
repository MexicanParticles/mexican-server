<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Converter\User\ListUserRequestConverter;
use App\Application\Converter\User\ViewUserRequestConverter;
use App\Domain\UseCase\User\ListUser\Interactors\ListUser;
use App\Domain\UseCase\User\ViewUser\Interactors\ViewUser;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', function (Request $request) {
            assert($this instanceof ContainerInterface);
            return (new ListUsersAction())->__invoke(
                new ListUserRequestConverter($request),
                $this->get(ListUser::class)
            );
        });
        $group->get('/{id}', function (Request $request) {
            assert($this instanceof ContainerInterface);
            return (new ViewUserAction())->__invoke(
                new ViewUserRequestConverter($request),
                $this->get(ViewUser::class)
            );
        });
    });
};
