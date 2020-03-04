<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Room\Create\Inputs;

use Psr\Http\Message\ResponseInterface as Response;

/**
 * @package App\Domain\UseCase\Room\Create\Inputs
 */
interface CreateRoomInputBoundary
{
    /**
     * @param CreateRoomInputDataInterface $inputData
     * @return Response
     */
    public function __invoke(CreateRoomInputDataInterface $inputData): Response;
}
