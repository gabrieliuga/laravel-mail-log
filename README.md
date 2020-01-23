# Laravel Mail Log

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gabrieliuga/laravel-mail-log.svg?style=flat-square)](https://packagist.org/packages/gabrieliuga/laravel-mail-log)
[![Build Status](https://img.shields.io/travis/gabrieliuga/laravel-mail-log/master.svg?style=flat-square)](https://travis-ci.org/gabrieliuga/laravel-mail-log)
[![Quality Score](https://img.shields.io/scrutinizer/g/gabrieliuga/laravel-mail-log.svg?style=flat-square)](https://scrutinizer-ci.com/g/gabrieliuga/laravel-mail-log)
[![StyleCI](https://github.styleci.io/repos/234824362/shield?branch=master)](https://github.styleci.io/repos/234824362)
[![Total Downloads](https://img.shields.io/packagist/dt/gabrieliuga/laravel-mail-log.svg?style=flat-square)](https://packagist.org/packages/gabrieliuga/laravel-mail-log)

Log all outgoing emails from your laravel application

## Installation

You can install the package via composer:

```bash
composer require gabrieliuga/laravel-mail-log
```

## Usage

``` bash
artisan migrate

artisan vendor:publish --tag=maillog-config

```
#### Setup auto clear command in app/Console/Kernel.php add ClearOldEmails::class
```php
/**
 * The Artisan commands provided by your application.
 *
 * @var array
 */
protected $commands = [
    ClearOldEmails::class,
];

/**
 * Define the application's command schedule.
 *
 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
 * @return void
 */
protected function schedule(Schedule $schedule)
{
    $schedule->command('giuga:purge-mail-log')->daily();
}

```

### Testing

``` bash
phpunit
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email me@iuga.dev instead of using the issue tracker.

## Credits

- [Gabriel Iuga](https://github.com/gabrieliuga)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
