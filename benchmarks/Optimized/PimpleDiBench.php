<?php

namespace PhpBench\Benchmarks\Container\Optimized;

use Pimple\Container;

class PimpleBench extends OptimizedBench
{
    private $container;

    public function init()
    {
        $container = new Container();
        $container['bicycle_factory'] = function ($c) {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory;
        };
        $this->container = $container;
    }

    /**
     * @revs 1000
     */
    public function benchGet()
    {
        $this->container['bicycle_factory'];
    }
}

