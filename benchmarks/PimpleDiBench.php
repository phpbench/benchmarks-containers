<?php

namespace PhpBench\Benchmarks\Container;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Pimple\Container;

/**
 * @beforeMethod init
 * @iterations 4
 */
class PimpleBench extends AbstractBench
{
    private $container;

    public function init()
    {
        $container = new Container();
        $container['bicycle_factory'] = function ($c) {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory;
        };
        $this->container = $container;
    }

    /**
     * @revs 1000
     */
    public function benchGet()
    {
        $this->container['bicycle_factory'];
    }
}

