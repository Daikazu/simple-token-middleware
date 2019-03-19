# Simple Token Middleware

[![Build Status](https://travis-ci.org/daikazu/simple-token-middleware.svg?branch=master)](https://travis-ci.org/daikazu/simple-token-middleware)
[![styleci](https://styleci.io/repos/176398914/shield)](https://styleci.io/repos/176398914)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/daikazu/simple-token-middleware/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/daikazu/simple-token-middleware/?branch=master)
<!--[![SensioLabsInsight](https://insight.sensiolabs.com/projects/CHANGEME/mini.png)](https://insight.sensiolabs.com/projects/CHANGEME)-->
<!--[![Coverage Status](https://coveralls.io/repos/github/daikazu/simple-token-middleware/badge.svg?branch=master)](https://coveralls.io/github/daikazu/simple-token-middleware?branch=master)-->

[![Packagist](https://img.shields.io/packagist/v/daikazu/simple-token-middleware.svg)](https://packagist.org/packages/daikazu/simple-token-middleware)
[![Packagist](https://poser.pugx.org/daikazu/simple-token-middleware/d/total.svg)](https://packagist.org/packages/daikazu/simple-token-middleware)
[![Packagist](https://img.shields.io/packagist/l/daikazu/simple-token-middleware.svg)](https://packagist.org/packages/daikazu/simple-token-middleware)

Small package to quickly add custom middleware to your laravel app to easily restrict access to your routes.

## Installation

Install via composer
```bash
composer require daikazu/simple-token-middleware
```

### Register Service Provider

**Note! This and next step are optional if you use laravel>=5.5 with package
auto discovery feature.**

Add service provider to `config/app.php` in `providers` section
```php
Daikazu\SimpleTokenMiddleware\ServiceProvider::class,
```

### Register Facade

Register package facade in `config/app.php` in `aliases` section
```php
Daikazu\SimpleTokenMiddleware\Facades\SimpleTokenMiddleware::class,
```

### Publish Configuration File

```bash
php artisan vendor:publish --provider="Daikazu\SimpleTokenMiddleware\ServiceProvider" --tag="config"
```

## Usage

Add `SIMPLE_TOKEN=my_secret_token` to your `.env` file,

use the middleware name `simple.token` in your route assignment.
```php

Route::post('/api/my-protected-route', 'Controller@index')->middleware('simple.token');

```

## Security

If you discover any security related issues, please email 
instead of using the issue tracker.

## Credits

- [](https://github.com/daikazu/simple-token-middleware)
- [All contributors](https://github.com/daikazu/simple-token-middleware/graphs/contributors)

This package is bootstrapped with the help of
[melihovv/laravel-package-generator](https://github.com/melihovv/laravel-package-generator).
