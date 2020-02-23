<?php

declare(strict_types=1);

namespace App\Domain\UseCase\User\ListUser\Outputs;

use App\Domain\Model\User\Entities\User;
use Illuminate\Support\Collection;

class ListUserOutputData
{
    /**
     * @var Collection<User>
     */
    private $userCollection;
/**
     * @param Collection<User> $userCollection
     */
    public function __construct(Collection $userCollection)
    {
        $this->userCollection = $userCollection;
    }

    /**
     * @return Collection<User>
     */
    public function getAll(): Collection
    {
        return $this->userCollection;
    }
}
