PHP Container Benchmarking Suite
================================

[![Build Status](https://travis-ci.org/phpbench/benchmarks-containers.svg)](https://travis-ci.org/phpbench/benchmarks-containers)

This benchmarking suite compares PHP Dependency Injection Containers.

It is intended to be a base for developing a standard benchmarking suite for
all of the PHP containers out there.

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

We take no responsiblity for the accuracy of these benchmarks. If you want to
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
PhpDiBench | 0.306μs | 0.693μs | 22.049μs | 50.622μs
PhpBenchBench | 0.237μs |  |  | 1.522μs
IlluminateBench | 0.733μs |  | 3.162μs | 8.171μs
PimpleBench | 0.414μs |  | 1.457μs | 3.704μs
SymfonyDiBench | 0.435μs | 1.001μs | 0.882μs | 3.797μs
ZendServiceManagerBench | 0.259μs |  | 1.164μs | 4.139μs
LeagueBench | 0.637μs |  | 1.906μs | 8.326μs

### Memory

**NOTE**: Memory is `memory_get_peak_usage` after executing the operation 1000 times.

benchmark | mem | benchGetOptimized | benchGetUnoptimized | benchGetPrototype | benchLifecycle
 --- | --- | --- | --- | --- | --- 
PhpDiBench | 1,066,779b | 1,066,779b | 990,576b | 1,066,792b | 4,065,592b
PhpBenchBench | 754,936b | 754,936b |  |  | 754,248b
IlluminateBench | 986,328b | 986,328b |  | 986,336b | 985,648b
PimpleBench | 764,064b | 764,064b |  | 764,064b | 763,376b
SymfonyDiBench | 916,744b | 916,744b | 1,123,880b | 916,744b | 916,056b
ZendServiceManagerBench | 902,008b | 902,008b |  | 902,008b | 2,991,968b
LeagueBench | 885,168b | 885,168b |  | 885,168b | 2,715,720b

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
