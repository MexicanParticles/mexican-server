<?php declare(strict_types=1);

namespace App\Infrastructure\Cache\Redis;

use RuntimeException;

class RedisKeyAlreadyExistsException extends RuntimeException
{

}
