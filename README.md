PHP Container Benchmarking Suite
================================

This benchmarking suite compares PHP Dependency Injection Containers.

Including:

- [PHP-DI](https://github.com/PHP-DI/PHP-DI).
- [Symfony Dependency Injection](https://github.com/symfony/DependencyInjection).
- [Pimple](https://github.com/silexphp/Pimple).
- [PHPBench Container](https://github.com/phpbench/phpbench).

Note that PHPBench Container is not the Not a "real" container, but a minimal
ad-hoc call-back based container used by PHPBench itself.

Run the Benchmarks
------------------

````bash
$ composer install
$ ./vendor/bin/phpbench run --report=containers
````

