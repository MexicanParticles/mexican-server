<?php
declare(strict_types=1);

namespace App\Application\Actions\User;


use App\Application\Converter\User\ListUserRequestConverter;
use App\Domain\UseCase\User\ListUser\Inputs\ListUserInputBoundary;
use Psr\Http\Message\ResponseInterface as Response;

class ListUsersAction
{
    /**
     * @param ListUserRequestConverter $input
     * @param ListUserInputBoundary $inputBoundary
     * @return Response
     */
    public function __invoke(ListUserRequestConverter $input, ListUserInputBoundary $inputBoundary): Response
    {
        return $inputBoundary->__invoke($input);
    }
}
