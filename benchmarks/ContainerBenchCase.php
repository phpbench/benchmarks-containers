<?php

namespace PhpBench\Benchmarks\Container;

use Symfony\Component\Filesystem\Filesystem;

/**
 * @BeforeMethods({"clearCache"}, extend=true)
 * @Iterations(30)
 * @Revs(1000)
 */
abstract class ContainerBenchCase
{
    public function __construct()
    {
        $this->cacheDir = __DIR__ . '/../cache';
    }

    public function clearCache()
    {
        if (file_exists($this->cacheDir)) {
            $fs = new Filesystem();
            $fs->remove($this->cacheDir);
        }
        mkdir($this->cacheDir);
    }

    abstract public function initOptimized();

    abstract public function initUnoptimized();

    abstract public function initPrototype();

    /**
     * Return a single instance of
     * PhpBench\Benchmarks\Container\Acme\BicycleFactory from the container.
     *
     * @Groups(value={"optimized"})
     * @BeforeMethods({"initOptimized"}, extend=true)
     */
    abstract public function benchGetOptimized();

    /**
     * Return a single instance of
     * PhpBench\Benchmarks\Container\Acme\BicycleFactory from an unoptimized container.
     *
     * @Groups({"unoptimized"})
     * @BeforeMethods({"initUnoptimized"}, extend=true)
     */
    abstract public function benchGetUnoptimized();

    /**
     * Return a new instance (prototype) of
     * PhpBench\Benchmarks\Container\Acme\BicycleFactory from the container.
     *
     * @Groups({"prototype"})
     * @BeforeMethods({"initPrototype"}, extend=true)
     */
    abstract public function benchGetPrototype();

    /**
     * As with benchGetOptimized but take into account the whole lifecycle
     *
     * @Groups({"lifecycle"})
     */
    abstract public function benchLifecycle();
}
