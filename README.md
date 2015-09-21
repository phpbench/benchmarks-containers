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

Note that PHPBench Container is not a "real" container, but a minimal
ad-hoc call-back based container used by PHPBench itself.

Run the Benchmarks
------------------

````bash
$ composer install
$ ./vendor/bin/phpbench run --report=all
````

