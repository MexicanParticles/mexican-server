<?php

declare(strict_types=1);

namespace Tests\Helper;

/**
 * @package Tests\Helper
 */
trait AssertionTestableTrait
{
    /**
     * @var string|false|null
     */
    private $zendAssertions;

    /**
     * @var string|false|null
     */
    private $assertException;

    final private function setAssertionSetting(): void
    {
        $this->zendAssertions = ini_get('zend.assertions');
        $this->assertException = ini_get('assert.exception');
        ini_set('zend.assertions', '1');
        ini_set('assert.exception', '1');
    }

    final private function revertAssertionSetting(): void
    {
        if (is_string($this->zendAssertions)) {
            ini_set('zend.assertions', $this->zendAssertions);
        }
        if (is_string($this->assertException)) {
            ini_set('assert.exception', $this->assertException);
        }
    }
}
