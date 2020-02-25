<?php

declare(strict_types=1);

namespace App\Domain\UseCase\User\ViewUser\Outputs;

use App\Domain\Model\User\Entities\User;

class ViewUserOutputData
{
    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
