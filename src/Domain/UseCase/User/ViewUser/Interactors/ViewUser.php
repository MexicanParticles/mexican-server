<?php

declare(strict_types=1);

namespace App\Domain\UseCase\User\ViewUser\Interactors;

use App\Domain\UseCase\User\DataAccessInterfaces\UserRepository;
use App\Domain\UseCase\User\ViewUser\Inputs\ViewUserInputBoundary;
use App\Domain\UseCase\User\ViewUser\Inputs\ViewUserInputDataInterface;
use App\Domain\UseCase\User\ViewUser\Outputs\ViewUserOutputBoundary;
use App\Domain\UseCase\User\ViewUser\Outputs\ViewUserOutputData;
use Psr\Http\Message\ResponseInterface as Response;

class ViewUser implements ViewUserInputBoundary
{
    /**
     * @var UserRepository
     */
    private $repository;
/**
     * @inject
     * @var ViewUserOutputBoundary
     */
    private $outputBoundary;
/**
     * @param UserRepository         $repository
     * @param ViewUserOutputBoundary $outputBoundary
     */
    public function __construct(UserRepository $repository, ViewUserOutputBoundary $outputBoundary)
    {
        $this->repository = $repository;
        $this->outputBoundary = $outputBoundary;
    }

    /**
     * @param ViewUserInputDataInterface $input
     * @return Response
     */
    public function __invoke(ViewUserInputDataInterface $input): Response
    {
        $user = $this
            ->repository
            ->findUserById($input->getUserId());
        return $this
            ->outputBoundary
            ->__invoke(new ViewUserOutputData($user));
    }
}
