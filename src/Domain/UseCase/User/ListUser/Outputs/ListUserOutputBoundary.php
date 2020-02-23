<?php

declare(strict_types=1);

namespace App\Domain\UseCase\User\ListUser\Outputs;

use Psr\Http\Message\ResponseInterface as Response;

interface ListUserOutputBoundary
{
    /**
     * @param ListUserOutputData $outputData
     * @return Response
     */
    public function __invoke(ListUserOutputData $outputData): Response;
}
