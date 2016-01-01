<?php

namespace PhpBench\Benchmarks\Container;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @Groups({"symfony"}, extend=true)
 */
class SymfonyDiBench extends ContainerBenchCase
{
    private $container;

    public function benchGetOptimized()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchGetUnoptimized()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchGetPrototype()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchLifecycle()
    {
        $this->init();
        $this->container->get('bicycle_factory');
    }

    public function init($optimize = true, $prototype = false)
    {
        $containerFile = $this->cacheDir . '/container.php';
        $builder = new ContainerBuilder();
        $definition = $builder->register('bicycle_factory', 'PhpBench\Benchmarks\Container\Acme\BicycleFactory');

        if ($prototype) {
            $definition->setScope(ContainerInterface::SCOPE_PROTOTYPE);
        }

        if (false === $optimize) {
            $this->container = $builder;
            return;
        }

        $dumper = new PhpDumper($builder);
        file_put_contents($containerFile, $dumper->dump());

        require_once($containerFile);
        $container = new \ProjectServiceContainer();

        $this->container = $container;
    }

    public function initOptimized()
    {
        $this->init(true, true);
    }

    public function initUnoptimized()
    {
        $this->init(false);
    }

    public function initPrototype()
    {
        $this->init(true, true);
    }
}
