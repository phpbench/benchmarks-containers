PHP Container Benchmarking Suite
================================

[![Build Status](https://travis-ci.org/phpbench/benchmarks-containers.svg)](https://travis-ci.org/phpbench/benchmarks-containers)

This benchmarking suite compares PHP Dependency Injection Containers. Its sort
of an example project for [PHPBench](https://github.com/phpbench/phpbench).

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
- [Aura DI](https://github.com/auraphp/aura.di)

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
aura/di                             3.1.0   A serializable dependency
injection container with constructor and setter injectio...
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

## Suite #1339f97fb7f96efa6de544e9f63f6116e81f85e2 2016-04-07 15:59:32

50 iterations, 1000 revolutions, 5 warmup revolutions, stdev < 3%

### Environment

provider | key | value
 --- | --- | --- 
uname | os | Linux
uname | host | dtlt410
uname | release | 4.2.0-1-amd64
uname | version | #1 SMP Debian 4.2.6-1 (2015-11-10)
uname | machine | x86_64
php | version | 7.0.3-3
unix-sysload | l1 | 1.34
unix-sysload | l5 | 1.16
unix-sysload | l15 | 0.85
vcs | system | git
vcs | branch | master
vcs | version | ce85c2f9b04832e4a5d0e47ff1a9bf40c3b72090
baseline | nothing | 0.015020370483398
baseline | md5 | 0.27108192443848
baseline | file_rw | 1.3530254364014

### Time

benchmark | benchGetOptimized | benchGetUnoptimized | benchGetPrototype | benchLifecycle
 --- | --- | --- | --- | --- 
PhpDiBench | 0.330μs | 0.725μs | 5.726μs | 23.315μs
PhpBenchBench | 0.242μs |  |  | 1.443μs
IlluminateBench | 0.734μs |  | 3.206μs | 8.128μs
AuraDiBench | 0.297μs |  | 1.772μs | 8.933μs
PimpleBench | 0.419μs |  | 1.461μs | 3.728μs
SymfonyDiBench | 0.433μs | 0.993μs | 0.873μs | 3.783μs
ZendServiceManagerBench | 0.266μs |  | 1.169μs | 3.439μs
LeagueBench | 0.628μs |  | 1.883μs | 7.628μs

**NOTE**: Memory is `memory_get_peak_usage` after executing the operation 1000 times.

### Memory

benchmark | benchGetOptimized | benchGetUnoptimized | benchGetPrototype | benchLifecycle
 --- | --- | --- | --- | --- | --- 
PhpDiBench | 1,037,152b | 991,016b | 1,037,152b | 5,881,272b
PhpBenchBench | 755,912b |  |  | 755,224b
IlluminateBench | 987,304b |  | 987,312b | 986,624b
AuraDiBench | 881,248b |  | 881,248b | 880,560b
PimpleBench | 765,040b |  | 765,040b | 764,352b
SymfonyDiBench | 917,720b | 1,124,856b | 917,720b | 917,032b
ZendServiceManagerBench | 902,984b |  | 902,984b | 2,992,944b
LeagueBench | 886,144b |  | 886,144b | 2,716,696b

Alternatively you may look at the latest [travis
build](https://travis-ci.org/phpbench/benchmarks-containers).

Run the Benchmarks
------------------

````bash
$ composer install
$ ./vendor/bin/phpbench run --report=all
````

or

```bash
$ ./vendor/bin/phpbench run --store
$ ./vendor/bin/phpbench show latest --report=all
```

For the HTML report:

```
$ ./vendor/bin/phpbench show latest --report=all --output=container_html
```
