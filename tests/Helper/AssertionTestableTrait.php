<?php

declare(strict_types=1);

namespace Tests\Helper;

/**
 * @package Tests\Helper
 */
trait AssertionTestableTrait
{
    private $zendAssertions;
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
        $this->zendAssertions = ini_get('zend.assertions');
        $this->assertException = ini_get('assert.exception');
        ini_set('zend.assertions', $this->zendAssertions);
        ini_set('assert.exception', $this->assertException);
    }
}
