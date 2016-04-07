<?php

namespace PhpBench\Benchmarks\Container;

use DI\ContainerBuilder;
use Doctrine\Common\Cache\ArrayCache;

/**
 * @Groups({"php-di"}, extend=true)
 * @BeforeClassMethods({"clearCache"})
 */
class PhpDiBench extends ContainerBenchCase
{
    private $container;

    private static function createBuilder()
    {
        //$cache = new ArrayCache(self::getCacheDir());
        $builder = new ContainerBuilder();
        //$builder->useAutowiring(false);
        $builder->addDefinitions(array(
            'bicycle_factory' => \DI\object('PhpBench\Benchmarks\Container\Acme\BicycleFactory')
        ));
        //$builder->setDefinitionCache($cache);

        return $builder;
    }

    public function initOptimized()
    {
        $builder = self::createBuilder();
        $container = $builder->build();
        $this->container = $container;
    }

    public function initUnoptimized()
    {
        $builder = new ContainerBuilder();
        $this->container = $builder->build();
        $this->container->set('bicycle_factory', \DI\object('PhpBench\Benchmarks\Container\Acme\BicycleFactory'));
    }

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
        $this->container->make('bicycle_factory');
    }

    public function benchLifecycle()
    {
        $this->initOptimized();
        $this->container->get('bicycle_factory');
    }
}
