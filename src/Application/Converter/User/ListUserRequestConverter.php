<?php

declare(strict_types=1);

namespace App\Application\Converter\User;

use App\Domain\UseCase\User\ListUser\Inputs\ListUserInputDataInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class ListUserRequestConverter implements ListUserInputDataInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
