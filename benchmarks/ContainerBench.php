<?php

namespace PhpBench\Benchmarks\Container;

use Symfony\Component\Filesystem\Filesystem;

/**
 * @beforeMethod init
 * @beforeMethod clearCache
 * @iterations 4
 */
abstract class ContainerBench
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

    abstract public function init();
    abstract public function benchGet();
}
