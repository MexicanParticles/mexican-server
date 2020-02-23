<?php

declare(strict_types=1);

namespace App\Application\Converter\User;

use App\Domain\UseCase\User\ViewUser\Inputs\ViewUserInputDataInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class ViewUserRequestConverter implements ViewUserInputDataInterface
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return (int) $this->request->getAttribute('id');
    }
}
