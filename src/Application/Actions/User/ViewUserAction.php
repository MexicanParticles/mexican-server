<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Application\Converter\User\ViewUserRequestConverter;
use App\Domain\UseCase\User\ViewUser\Inputs\ViewUserInputBoundary;
use Psr\Http\Message\ResponseInterface as Response;

class ViewUserAction
{
    /**
     * @param ViewUserRequestConverter $input
     * @param ViewUserInputBoundary $inputBoundary
     * @return Response
     */
    public function __invoke(ViewUserRequestConverter $input, ViewUserInputBoundary $inputBoundary): Response
    {
        return $inputBoundary->__invoke($input);
    }
}
