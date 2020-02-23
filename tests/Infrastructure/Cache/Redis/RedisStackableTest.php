<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Cache\Redis;

use App\Infrastructure\Cache\Redis\RedisStackableTrait;
use JsonSerializable;
use Redis;
use Tests\TestCase;

/**
 * @package Tests\Infrastructure\Cache\Redis
 * @TODO add tests for exceptions
 */
class RedisStackableTest extends TestCase
{
    private $redis;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        parent::setUp();
        $app = $this->getAppInstance();
        $redis = $app->getContainer()->get(Redis::class);
        $this->redis = new class ($redis) {
            use RedisStackableTrait;

            private $redis;

            public function __construct(Redis $redis)
            {
                $this->redis = $redis;
            }
        };
    }

    public function testPublicMethodsWithArrayWithString(): void
    {
        $stack = ['hoge', 'fuga', 'piyo'];
        $this->redis->setAsStack($stack, $key = 'mexico');

        self::assertFalse($this->redis->isEmpty($key));
        self::assertSame(3, $this->redis->count($key));
        self::assertSame('piyo', $this->redis->pop($key));

        self::assertFalse($this->redis->isEmpty($key));
        self::assertSame(2, $this->redis->count($key));
        self::assertSame('fuga', $this->redis->pop($key));

        self::assertFalse($this->redis->isEmpty($key));
        self::assertSame(1, $this->redis->count($key));
        self::assertSame('hoge', $this->redis->pop($key));

        self::assertTrue($this->redis->isEmpty($key));
        self::assertSame(0, $this->redis->count($key));
    }

    public function testPublicMethodsWithCollectionWithJsonSerializable(): void
    {
        $jsonSerializableA = new class () implements JsonSerializable {
            /**
             * @return string
             */
            public function jsonSerialize(): string
            {
                return 'hogehoge';
            }
        };
        $jsonSerializableB = new class () implements JsonSerializable {
            /**
             * @return string
             */
            public function jsonSerialize(): string
            {
                return 'fugafuga';
            }
        };
        $jsonSerializableC = new class () implements JsonSerializable {
            /**
             * @return string
             */
            public function jsonSerialize(): string
            {
                return 'piyopiyo';
            }
        };

        $stack = collect([$jsonSerializableA, $jsonSerializableB, $jsonSerializableC]);
        $this->redis->setAsStack($stack, $key = 'mexico');

        self::assertFalse($this->redis->isEmpty($key));
        self::assertSame(3, $this->redis->count($key));
        self::assertSame('piyopiyo', $this->redis->pop($key));

        self::assertFalse($this->redis->isEmpty($key));
        self::assertSame(2, $this->redis->count($key));
        self::assertSame('fugafuga', $this->redis->pop($key));

        self::assertFalse($this->redis->isEmpty($key));
        self::assertSame(1, $this->redis->count($key));
        self::assertSame('hogehoge', $this->redis->pop($key));

        self::assertTrue($this->redis->isEmpty($key));
        self::assertSame(0, $this->redis->count($key));
    }
}
