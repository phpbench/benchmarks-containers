<?php

namespace PhpBench\Benchmarks\Container;

use Symfony\Component\Filesystem\Filesystem;

/**
 * @BeforeClassMethods({"clearCache"}, extend=true)
 * @Iterations(50)
 * @Revs({1, 1000})
 */
abstract class ContainerBenchCase
{
    public static function getCacheDir()
    {
        return __DIR__ . '/../cache';
    }

    public static function clearCache()
    {
        if (file_exists(self::getCacheDir())) {
            $fs = new Filesystem();
            $fs->remove(self::getCacheDir());
        }
        mkdir(self::getCacheDir());
    }

    abstract public function initOptimized();

    abstract public function initUnoptimized();

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
     * @BeforeMethods({"initOptimized"}, extend=true)
     */
    abstract public function benchGetPrototype();

    /**
     * As with benchGetOptimized but take into account the whole lifecycle
     *
     * @Groups({"lifecycle"})
     */
    abstract public function benchLifecycle();
}
