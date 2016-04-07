<?php

namespace PhpBench\Benchmarks\Container;

use Aura\Di\Container;
use Aura\Di\Injection\InjectionFactory;
use Aura\Di\Resolver\Reflector;
use Aura\Di\Resolver\Resolver;

/**
 * @Groups({"aura-di"}, extend=true)
 */
class AuraDiBench extends ContainerBenchCase
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
        $this->container->get('bicycle_factory');
    }

    public function benchGetPrototype()
    {
        $this->container->newInstance('PhpBench\Benchmarks\Container\Acme\BicycleFactory');
    }

    public function benchLifecycle()
    {
        $this->init();
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
        $container = new Container(new InjectionFactory(new Resolver(new Reflector())));

        // alternatively you can do
        // $builder = new \Aura\Di\ContainerBuilder();
        // $container = $builder->newInstance();

        $container->set('bicycle_factory', $container->lazyNew('PhpBench\Benchmarks\Container\Acme\BicycleFactory'));

        $this->container = $container;
    }
}
