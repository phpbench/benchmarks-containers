<?php

namespace PhpBench\Benchmarks\Container\Optimized;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;

class SymfonyDiBench extends OptimizedBench
{
    private $container;

    public function init()
    {
        $containerFile = $this->cacheDir . '/container.php';
        $builder = new ContainerBuilder();
        $builder->register('bicycle_factory', 'PhpBench\Benchmarks\Container\Acme\BicycleFactory');
        $dumper=  new PhpDumper($builder);
        file_put_contents($containerFile, $dumper->dump());

        require_once($containerFile);
        $container = new \ProjectServiceContainer();

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

