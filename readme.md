# Laravel queue size check
![GitHub release (with filter)](https://img.shields.io/github/v/release/SRWieZ/queue-size-health-check)
![Packagist PHP Version](https://img.shields.io/packagist/dependency-v/SRWieZ/queue-size-health-check/php)
![Packagist Downloads (custom server)](https://img.shields.io/packagist/dt/SRWieZ/queue-size-health-check)
![GitHub Repo stars](https://img.shields.io/github/stars/SRWieZ/queue-size-health-check?style=flat)
![Packagist License (custom server)](https://img.shields.io/packagist/l/SRWieZ/queue-size-health-check)
![GitHub Workflow Status (with event)](https://img.shields.io/github/actions/workflow/status/SRWieZ/queue-size-health-check/test.yml)

This package is for the people that prefer to use Spatie Health check package instead of `php artisan queue:monitor`

## Installation

Requirement : Before installing this package, please install and configure [Spatie Laravel Health](https://github.com/spatie/laravel-health).

```bash
composer require srwiez/queue-size-health-check
```

## Usage

```php
use QueueSizeCheck\QueueSizeCheck;

QueueSizeCheck::new()
    ->queue('static_cache', 3)
    ->queue('default', 100),
```

## Contribute / Roadmap
Hey, pull-request are welcome!

## Credits

Laravel queue size check was created by Eser DENIZ.

## License

Laravel queue size check PHP is licensed under the MIT License. See LICENSE for more information.
