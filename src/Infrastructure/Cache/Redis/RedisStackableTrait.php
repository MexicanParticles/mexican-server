<?php

declare(strict_types=1);

namespace App\Infrastructure\Cache\Redis;

use JsonSerializable;
use Redis;
use UnexpectedValueException;

/**
 * Behave as stack using the list of Redis.
 * @package App\Infrastructure\Cache\Redis
 * @see https://github.com/phpredis/phpredis#sorted-sets
 * @property Redis $redis
 */
trait RedisStackableTrait
{
    /**
     * @param iterable<string|JsonSerializable> $iterable
     * @param string                            $key
     * @throws RedisKeyAlreadyExistsException|UnexpectedValueException
     */
    public function setAsStack(iterable $iterable, string $key): void
    {
        if (false === $this->isEmpty($key)) {
            throw new RedisKeyAlreadyExistsException(sprintf('key: %s already exists', $key));
        }

        foreach ($iterable as $element) {
            if ($element instanceof JsonSerializable) {
                $value = $element->jsonSerialize();
            } elseif (is_string($element)) {
                $value = $element;
            } else {
                throw new UnexpectedValueException('Element to be stacked must be string or jsonSerializable');
            }

            $this->redis->lPush($key, (string) $value);
        }
    }

    /**
     * @param string $key
     * @return string
     * @throws RedisKeyNotExistsException
     */
    public function pop(string $key): string
    {
        $popped = $this->redis->lPop($key);
        if (false === $popped) {
            throw new RedisKeyNotExistsException(sprintf('key: %s not exists', $key));
        }
        assert(is_string($popped));
        return $popped;
    }

    /**
     * @param string $key
     * @return int
     */
    public function count(string $key): int
    {
        return $this->redis->lLen($key);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isEmpty(string $key): bool
    {
        return 0 === $this->count($key);
    }
}
