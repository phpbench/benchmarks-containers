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
        $this->container['bicycle_factory_prototype'];
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

    public function init()
    {
        $container = new Container();
        $closure = function ($c) {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory;
        };

        $prototype = $container->factory($closure);

        $container['bicycle_factory'] = $closure;
        $container['bicycle_factory_prototype'] = $prototype;
        $this->container = $container;
    }
}

