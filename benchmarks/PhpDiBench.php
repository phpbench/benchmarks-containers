<?php

namespace PhpBench\Benchmarks\Container;

use DI\ContainerBuilder;

/**
 * @beforeMethod init
 * @iterations 4
 */
class PhpDiBench extends AbstractBench
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
