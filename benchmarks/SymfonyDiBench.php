<?php

namespace PhpBench\Benchmarks\Container;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @Groups({"symfony"}, extend=true)
 * @BeforeClassMethods({"clearCache", "warmup"})
 */
class SymfonyDiBench extends ContainerBenchCase
{
    private $container;

    public static function warmup()
    {
        $containerFile = self::getCacheDir() . '/container.php';

        $builder = self::getContainer();
        $dumper = new PhpDumper($builder);
        file_put_contents($containerFile, $dumper->dump());
    }

    public static function getContainer()
    {
        $builder = new ContainerBuilder();
        $protoDefinition = $builder->register('bicycle_factory', 'PhpBench\Benchmarks\Container\Acme\BicycleFactory');
        $protoDefinition->setScope(ContainerInterface::SCOPE_PROTOTYPE);
        $definition = $builder->register('bicycle_factory_shared', 'PhpBench\Benchmarks\Container\Acme\BicycleFactory');

        return $builder;
    }

    public function benchGetOptimized()
    {
        $this->container->get('bicycle_factory_shared');
    }

    public function benchGetUnoptimized()
    {
        $this->container->get('bicycle_factory_shared');
    }

    public function benchGetPrototype()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchLifecycle()
    {
        $this->initOptimized();
        $this->container->get('bicycle_factory_shared');
    }

    public function initOptimized()
    {
        require_once(self::getCacheDir() . DIRECTORY_SEPARATOR . 'container.php');
        $container = new \ProjectServiceContainer();

        $this->container = $container;
    }

    public function initUnoptimized()
    {
        $this->container = self::getContainer();
    }
}
