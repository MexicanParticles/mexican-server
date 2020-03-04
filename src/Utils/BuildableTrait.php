<?php declare(strict_types=1);

namespace App\Utils;

/**
 * @package App\Util
 */
trait BuildableTrait
{
    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    private function set(string $key, $value): self
    {
        assert(property_exists(self::class, $key));
        $this->{$key} = $value;
        return $this;
    }
}
