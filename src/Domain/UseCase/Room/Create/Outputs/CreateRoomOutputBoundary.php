<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Room\Create\Outputs;

use Psr\Http\Message\ResponseInterface as Response;

interface CreateRoomOutputBoundary
{
    /**
     * @param CreateRoomOutputData $outputData
     * @return Response
     */
    public function __invoke(CreateRoomOutputData $outputData): Response;
}
