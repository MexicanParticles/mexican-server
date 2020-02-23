<?php declare(strict_types=1);

namespace App\Application\Presenters\User;

use App\Application\Presenters\BasePresenter;
use App\Domain\UseCase\User\ListUser\Outputs\ListUserOutputBoundary;
use App\Domain\UseCase\User\ListUser\Outputs\ListUserOutputData;
use Psr\Http\Message\ResponseInterface as Response;

class ListUserPresenter extends BasePresenter implements ListUserOutputBoundary
{
    /**
     * @param ListUserOutputData $outputData
     * @return Response
     */
    public function __invoke(ListUserOutputData $outputData): Response
    {
        return $this->respondWithData($outputData->getAll());
    }
}
