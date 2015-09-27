<?php

namespace PhpBench\Benchmarks\Container\Optimized;

use Illuminate\Container\Container;

class IlluminateContainerBench extends OptimizedBench
{
    private $container;

    public function init()
    {
        $builder = new Container();
        $builder->bind('bicycle_factory', function ($app) {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory();
        }, true);
        $this->container = $builder;
    }

    /**
     * @revs 1000
     */
    public function benchGet()
    {
        $this->container['bicycle_factory'];
    }
}

