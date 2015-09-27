<?php

namespace PhpBench\Benchmarks\Container\Unoptimized;

use PhpBench\DependencyInjection\Container;

/**
 * @group optimized
 */
class PhpBenchDiBench extends UnoptimizedBench
{
    private $container;

    public function init()
    {
        $container = new Container();
        $container->register('bicycle_factory', function ($c) {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory;
        });
        $this->container = $container;
    }

    /**
     * @revs 1000
     */
    public function benchGet()
    {
        $this->container->get('bicycle_factory');
    }
}

