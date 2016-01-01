<?php

namespace PhpBench\Benchmarks\Container;

use Pimple\Container;

/**
 * @Groups({"pimple"}, extend=true)
 */
class PimpleBench extends ContainerBenchCase
{
    private $container;

    /**
     * @Skip()
     */
    public function benchGetUnoptimized()
    {
    }

    public function benchGetOptimized()
    {
        $this->container['bicycle_factory'];
    }

    public function benchGetPrototype()
    {
        $this->container['bicycle_factory'];
    }

    public function benchLifecycle()
    {
        $this->init();
        $this->container['bicycle_factory'];
    }

    public function initUnoptimized()
    {
        $this->init();
    }

    public function initOptimized()
    {
        $this->init();
    }

    public function initPrototype()
    {
        $this->init(true);
    }

    public function init($prototype = false)
    {
        $container = new Container();
        $closure = function ($c) {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory;
        };

        if ($prototype) {
            $closure = $container->factory($closure);
        }

        $container['bicycle_factory'] = $closure;
        $this->container = $container;
    }
}

