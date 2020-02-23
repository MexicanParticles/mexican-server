<?php declare(strict_types=1);

namespace App\Domain\UseCase\User\ListUser\Interactors;

use App\Domain\UseCase\User\DataAccessInterfaces\UserRepository;
use App\Domain\UseCase\User\ListUser\Inputs\ListUserInputBoundary;
use App\Domain\UseCase\User\ListUser\Inputs\ListUserInputDataInterface;
use App\Domain\UseCase\User\ListUser\Outputs\ListUserOutputBoundary;
use App\Domain\UseCase\User\ListUser\Outputs\ListUserOutputData;
use Psr\Http\Message\ResponseInterface as Response;

class ListUser implements ListUserInputBoundary
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @inject
     * @var ListUserOutputBoundary
     */
    private $outputBoundary;

    /**
     * @param UserRepository         $repository
     * @param ListUserOutputBoundary $outputBoundary
     */
    public function __construct(UserRepository $repository, ListUserOutputBoundary $outputBoundary)
    {
        $this->repository = $repository;
        $this->outputBoundary = $outputBoundary;
    }

    /**
     * @param ListUserInputDataInterface $input
     * @return Response
     */
    public function __invoke(ListUserInputDataInterface $input): Response
    {
        $userCollection = $this
            ->repository
            ->findAll();

        return $this
            ->outputBoundary
            ->__invoke(new ListUserOutputData($userCollection));
    }
}
