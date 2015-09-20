<?php

namespace PhpBench\Benchmarks\Container;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use PhpBench\Container;

/**
 * @beforeMethod init
 * @iterations 4
 */
class PhpBenchDiBench extends AbstractBench
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

