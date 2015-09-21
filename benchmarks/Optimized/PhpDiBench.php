<?php

namespace PhpBench\Benchmarks\Container\Optimized;

use DI\ContainerBuilder;

class PhpDiBench extends OptimizedBench
{
    private $container;

    public function init()
    {
        $builder = new ContainerBuilder();
        $builder->setDefinitionCache(new \DI\Cache\ArrayCache());
        $builder->writeProxiesToFile(true, 'tmp/proxies');
        $builder->addDefinitions(array(
            'bicycle_factory' => \DI\object('PhpBench\Benchmarks\Container\Acme\BicycleFactory')
        ));

        $this->container = $builder->build();

        // warm up the container
        $this->container->get('bicycle_factory');
    }

    /**
     * @revs 1000
     */
    public function benchGet()
    {
        $this->container->get('bicycle_factory');
    }
}
