# Laravel queue size check
[![Latest Stable Version](http://poser.pugx.org/srwiez/queue-size-health-check/v)](https://packagist.org/packages/srwiez/queue-size-health-check) [![Total Downloads](http://poser.pugx.org/srwiez/queue-size-health-check/downloads)](https://packagist.org/packages/srwiez/queue-size-health-check) [![Latest Unstable Version](http://poser.pugx.org/srwiez/queue-size-health-check/v/unstable)](https://packagist.org/packages/srwiez/queue-size-health-check) [![License](http://poser.pugx.org/srwiez/queue-size-health-check/license)](https://packagist.org/packages/srwiez/queue-size-health-check) [![PHP Version Require](http://poser.pugx.org/srwiez/queue-size-health-check/require/php)](https://packagist.org/packages/srwiez/queue-size-health-check)
![GitHub Workflow Status (with event)](https://img.shields.io/github/actions/workflow/status/SRWieZ/queue-size-health-check/test.yml?label=Tests)

This package is for the people that prefer to use Spatie Health check package instead of `php artisan queue:monitor`

## Installation

Requirement : Before installing this package, please install and configure [Laravel Health](https://github.com/spatie/laravel-health).

```bash
composer require srwiez/queue-size-health-check
```

## Usage

```php
QueueSizeCheck::new()
    ->queue('static_cache', 3)
    ->queue('default', 100),
```

## Contribute / Roadmap
Hey, pull-request are welcome!
Here is some of the things that can be improved
- Tests
- Github workflow to test again laravel versions

## Credits

Laravel queue size check was created by Eser DENIZ.

## License

Laravel queue size check PHP is licensed under the MIT License. See LICENSE for more information.