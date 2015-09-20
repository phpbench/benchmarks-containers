<?php

namespace PhpBench\Benchmarks\Container;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Illuminate\Container\Container;

/**
 * @beforeMethod init
 * @iterations 4
 */
class IlluminateContainerBench extends AbstractBench
{
    private $container;

    public function init()
    {
        $builder = new Container();
        $builder->bind('bicycle_factory', function ($app) {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory();
        });
        $this->container = $builder;
    }

    /**
     * @revs 1000
     */
    public function benchGet()
    {
        $this->container['bicycle_factory'];
    }
}

