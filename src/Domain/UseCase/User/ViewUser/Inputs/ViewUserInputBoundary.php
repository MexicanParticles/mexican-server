<?php declare(strict_types=1);

namespace App\Domain\UseCase\User\ViewUser\Inputs;

use Psr\Http\Message\ResponseInterface as Response;

interface ViewUserInputBoundary
{
    /**
     * @param ViewUserInputDataInterface $inputData
     * @return Response
     */
    public function __invoke(ViewUserInputDataInterface $inputData): Response;
}
