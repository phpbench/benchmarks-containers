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

benchmark | subject:benchGetOptimized:mode | subject:benchGetUnoptimized:mode | subject:benchGetPrototype:mode | subject:benchLifecycle:mode
 --- | --- | --- | --- | --- 
PhpDiBench | 0.317μs | 0.307μs | 4.670μs | 32.875μs
PhpBenchBench | 0.198μs |  |  | 1.251μs
IlluminateBench | 3.075μs |  | 0.118μs | 7.193μs
PimpleBench | 1.403μs |  | 1.402μs | 3.430μs
SymfonyDiBench | 0.377μs | 0.810μs | 0.834μs | 2.837μs
ZendServiceManagerBench | 0.214μs |  | 1.137μs | 2.681μs
LeagueBench | 0.614μs |  | 1.863μs | 6.575μs

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
