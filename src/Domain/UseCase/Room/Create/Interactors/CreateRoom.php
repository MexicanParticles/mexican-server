<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Room\CreateRoom\Interactors;

use App\Domain\Model\Room\Factories\PlayerFactory;
use App\Domain\Model\Room\Factories\RoomFactory;
use App\Domain\UseCase\Room\Create\Outputs\CreateRoomOutputData;
use App\Domain\UseCase\Room\DataAccessInterfaces\RoomRepository;
use App\Domain\UseCase\Room\Create\Inputs\CreateRoomInputBoundary;
use App\Domain\UseCase\Room\Create\Inputs\CreateRoomInputDataInterface;
use App\Domain\UseCase\Room\Create\Outputs\CreateRoomOutputBoundary;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * @package App\Domain\UseCase\Room\CreateRoom\Interactors
 */
class CreateRoom implements CreateRoomInputBoundary
{
    /**
     * @inject
     * @var RoomRepository
     */
    private RoomRepository $repository;

    /**
     * @inject
     * @var CreateRoomOutputBoundary
     */
    private CreateRoomOutputBoundary $outputBoundary;

    /**
     * @inject
     * @var PlayerFactory
     */
    private PlayerFactory $playerFactory;

    /**
     * @inject
     * @var RoomFactory
     */
    private RoomFactory $roomFactory;

    /**
     * @param RoomRepository           $repository
     * @param CreateRoomOutputBoundary $outputBoundary
     * @param PlayerFactory            $playerFactory
     * @param RoomFactory              $roomFactory
     */
    public function __construct(
        RoomRepository $repository,
        CreateRoomOutputBoundary $outputBoundary,
        PlayerFactory $playerFactory,
        RoomFactory $roomFactory
    ) {
        $this->repository = $repository;
        $this->outputBoundary = $outputBoundary;
        $this->playerFactory = $playerFactory;
        $this->roomFactory = $roomFactory;
    }

    /**
     * @param CreateRoomInputDataInterface $input
     * @return Response
     */
    public function __invoke(CreateRoomInputDataInterface $input): Response
    {
        $player = $this
            ->playerFactory
            ->initialize($input->getUserName());

        $room = $this
            ->roomFactory
            ->initialize($player);

        $this
            ->repository
            ->save($room);

        return $this
            ->outputBoundary
            ->__invoke(new CreateRoomOutputData($room));
    }
}
