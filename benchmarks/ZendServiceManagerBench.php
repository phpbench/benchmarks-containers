<?php

namespace PhpBench\Benchmarks\Container;

use PhpBench\Benchmarks\Container\Acme\BicycleFactory;
use Zend\ServiceManager\ServiceManager;

/**
 * @Groups({"phpbench"}, extend=true)
 */
class ZendServiceManagerBench extends ContainerBenchCase
{
    private $container;

    public function initOptimized()
    {
        $this->initUnoptimized();
    }

    public function initUnoptimized()
    {
        $this->container = new ServiceManager([
            'factories' => [
                'bicycle_factory' => function () { return new BicycleFactory(); },
                'bicycle_factory_prototype' => function () { return new BicycleFactory(); },
            ],
            'shared' => [
                'bicycle_factory_prototype' => false,
            ]
        ]);
    }

    public function benchLifecycle()
    {
        $this->initUnoptimized();
        $this->container->get('bicycle_factory');
    }

    public function benchGetOptimized()
    {
        $this->container->get('bicycle_factory');
    }

    /**
     * @Skip()
     */
    public function benchGetUnoptimized()
    {
    }

    public function benchGetPrototype()
    {
        $this->container->get('bicycle_factory_prototype');
    }
}
