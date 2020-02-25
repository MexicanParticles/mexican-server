<?php

declare(strict_types=1);

namespace App\Domain\UseCase\User\Exceptions;

use App\Domain\Exceptions\DomainRecordNotFoundException;

class UserNotFoundException extends DomainRecordNotFoundException
{
    /**
     * @var string
     */
    public $message = 'The user you requested does not exist.';
}
