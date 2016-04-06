<?php

namespace PhpBench\Benchmarks\Container;

use Aura\Di\ContainerBuilder;

/**
 * @Groups({"aura-di"}, extend=true)
 */
class AuraDiBench extends ContainerBenchCase
{
    private $container;

    public function benchGetUnoptimized()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchGetOptimized()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchGetPrototype()
    {
        $this->container->newInstance('PhpBench\Benchmarks\Container\Acme\BicycleFactory');
    }

    public function benchLifecycle()
    {        
        $this->container->get('bicycle_factory');
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
        $builder = new ContainerBuilder();
        $container = $builder->newInstance();

        $container->set('bicycle_factory', $container->lazyNew('PhpBench\Benchmarks\Container\Acme\BicycleFactory'));

        $this->container = $container;
    }
}
