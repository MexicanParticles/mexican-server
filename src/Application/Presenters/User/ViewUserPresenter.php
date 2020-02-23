<?php declare(strict_types=1);

namespace App\Application\Presenters\User;

use App\Application\Presenters\BasePresenter;
use App\Domain\UseCase\User\ViewUser\Outputs\ViewUserOutputBoundary;
use App\Domain\UseCase\User\ViewUser\Outputs\ViewUserOutputData;
use Psr\Http\Message\ResponseInterface as Response;

class ViewUserPresenter extends BasePresenter implements ViewUserOutputBoundary
{
    /**
     * @param ViewUserOutputData $outputData
     * @return Response
     */
    public function __invoke(ViewUserOutputData $outputData): Response
    {
        return $this->respondWithData($outputData->getUser());
    }
}
