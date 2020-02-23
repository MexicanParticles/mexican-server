<?php

declare(strict_types=1);

namespace App\Domain\UseCase\User\ListUser\Inputs;

use Psr\Http\Message\ResponseInterface as Response;

interface ListUserInputBoundary
{
    /**
     * @param ListUserInputDataInterface $inputData
     * @return Response
     */
    public function __invoke(ListUserInputDataInterface $inputData): Response;
}
