PHP Container Benchmarking Suite
================================

[![Build Status](https://travis-ci.org/phpbench/benchmarks-containers.svg)](https://travis-ci.org/phpbench/benchmarks-containers)

This benchmarking suite compares PHP Dependency Injection Containers.

Including:

- [PHP-DI](https://github.com/PHP-DI/PHP-DI).
- [Symfony Dependency Injection](https://github.com/symfony/DependencyInjection).
- [Pimple](https://github.com/silexphp/Pimple).
- [PHPBench Container](https://github.com/phpbench/phpbench).
- [Illuminate (Laravel) Container](https://github.com/illuminate/container)
- [Php League Container](http://container.thephpleague.com/)
- [Zend Service Manager](https://github.com/zendframework/zend-servicemanager)

Note that PHPBench Container is not a "real" container, but a minimal
ad-hoc call-back based container used by PHPBench itself.

Disclaimer
----------

I take no responsiblity for the accuracy of these benchmarks. If you want to
be sure of the results please clone this repository, look at the code, and run
the benchmarks yourself.

If you are a container maintainer and you notice that the benchmarks are not
fair, then please make a pull request.

The benchmarks do not cover all contingencies, infact they are currently quite
limited. Please feel free to make pull requests as required.

Versions
--------

```
illuminate/container                v5.2.28 The Illuminate Container package.
league/container                    2.2.0   A fast and intuitive dependency injection container.
php-di/php-di                       5.2.2   The dependency injection container
phpbench/phpbench                   0.11.1  PHP Benchmarking Framework
pimple/pimple                       v3.0.2  Pimple, a simple Dependency
symfony/dependency-injection        v2.8.4  Symfony DependencyInjection
zendframework/zend-servicemanager   3.0.3
```

Results
-------

- All containers are expected to be optimized except in the `unoptimized
  test`.

Subjects (all executed 1000 times):

- `GetOptimizedNode`: Return a shared service (expected cache effect).
- `GetUnoptimized`: Return a shared service without optimization (i.e. no
  dumping of the container, etc).
- `GetPrototype`: Return a new instance of the service.
- `Lifecycle`: Instantiate the container and return a shared service.

### Time

benchmark | benchGetOptimized | benchGetUnoptimized | benchGetPrototype | benchLifecycle
 --- | --- | --- | --- | --- 
PhpDiBench | 0.328μs | 0.690μs | 4.659μs | 34.985μs
PhpBenchBench | 0.227μs |  |  | 1.437μs
IlluminateBench | 0.737μs |  | 3.098μs | 8.038μs
PimpleBench | 1.440μs |  | 1.433μs | 3.714μs
SymfonyDiBench | 0.433μs | 0.987μs | 0.883μs | 3.756μs
ZendServiceManagerBench | 0.275μs |  | 1.177μs | 3.836μs
LeagueBench | 0.624μs |  | 1.916μs | 7.590μs

### Memory

**NOTE**: Memory is `memory_get_peak_usage` after executing the operation 1000 times.

benchmark | benchGetOptimized | benchGetUnoptimized | benchGetPrototyp | benchLifecycle
 --- | --- | --- | --- | --- | --- 
PhpDiBench | 1,006,056b | 990,144b | 1,006,056b | 8,062,024b
PhpBenchBench | 754,872b |  |  | 754,184b
IlluminateBench | 986,264b |  | 986,272b | 985,584b
PimpleBench | 764,000b |  | 764,000b | 763,312b
SymfonyDiBench | 916,680b | 1,123,816b | 916,680b | 915,992b
ZendServiceManagerBench | 901,944b |  | 901,944b | 2,991,904b
LeagueBench | 885,104b |  | 885,104b | 2,715,656b

Alternatively you may look at the latest [travis
build](https://travis-ci.org/phpbench/benchmarks-containers).

Run the Benchmarks
------------------

````bash
$ composer install
$ ./vendor/bin/phpbench run --report=container
````

or

```bash
$ ./vendor/bin/phpbench run --store
$ ./vendor/bin/phpbench show latest --report=container
```
