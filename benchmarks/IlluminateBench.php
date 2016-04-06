<?php

namespace PhpBench\Benchmarks\Container;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Illuminate\Container\Container;

/**
 * @Groups({"illuminate"}, extend=true)
 */
class IlluminateBench extends ContainerBenchCase
{
    private $container;

    /**
     * @BeforeMethods({"init"})
     */
    public function benchGetOptimized()
    {
        $this->container['bicycle_factory_shared'];
    }

    /**
     * @Skip()
     */
    public function benchGetUnoptimized()
    {
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

    public function initOptimized()
    {
    }

    public function initUnoptimized()
    {
        $this->init();
    }

    public function init()
    {
        $builder = new Container();
        $builder->bind('bicycle_factory_shared', function ($app) {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory();
        }, false);
        $builder->bind('bicycle_factory', function ($app) {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory();
        }, true);
        $this->container = $builder;
    }
}
