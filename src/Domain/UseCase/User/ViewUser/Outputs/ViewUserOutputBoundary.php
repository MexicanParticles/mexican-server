<?php

declare(strict_types=1);

namespace App\Domain\UseCase\User\ViewUser\Outputs;

use Psr\Http\Message\ResponseInterface as Response;

interface ViewUserOutputBoundary
{
    /**
     * @param ViewUserOutputData $outputData
     * @return Response
     */
    public function __invoke(ViewUserOutputData $outputData): Response;
}
