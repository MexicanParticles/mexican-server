<?php declare(strict_types=1);

namespace App\Utils;

/**
 * Builder that can be initialized after build()
 * @package App\Util
 */
trait AbstractInitializableBuilderTrait
{
    /**
     * @return mixed
     */
    abstract protected function build();

    /**
     * Initialize the builder.
     */
    abstract protected function initialize(): void;

    /**
     * @return mixed
     */
    final public function buildWithInitializing()
    {
        $built = $this->build();
        $this->initialize();
        return $built;
    }
}
