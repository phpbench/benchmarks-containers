<?php

namespace PhpBench\Benchmarks\Container\Unoptimized;

use DI\ContainerBuilder;

class PhpDiBench extends UnoptimizedBench
{
    private $container;

    public function init()
    {
        $builder = new ContainerBuilder();

        $this->container = $builder->build();
        $this->container->set('bicycle_factory', \DI\object('PhpBench\Benchmarks\Container\Acme\BicycleFactory'));
    }

    /**
     * @revs 1000
     */
    public function benchGet()
    {
        $this->container->get('bicycle_factory');
    }
}
