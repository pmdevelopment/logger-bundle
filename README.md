# LoggerBundle

It is a Symfony Bundle with the goal to provide a persistent logger, which allows parallel (but not compatible!) to the integrated and easy error management for the productive environment. 

## Setup

Add to composer:

```console
composer require pmdevelopment/logger-bundle
```

Add to Bundles in AppKernel:

```php
new PM\Bundle\LoggerBundle\PMLoggerBundle(),
```

Import services in config.yml:

```yml
imports:
    - { resource: "@PMLoggerBundle/Resources/config/services.yml" }
```

Create and execute migrations:

```console
php bin/console doctr:migr:diff
php bin/console doctr:migr:migr
```