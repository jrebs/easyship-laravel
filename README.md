# easyship-laravel

 [![License](https://img.shields.io/packagist/l/jrebs/easyship-php.svg?style=flat-square)](https://packagist.org/packages/jrebs/easyship-php)

A PHP supplemental package to the
[easyship-php](https://github.com/jrebs/easyship-php) package which
allows users to quickly and easily integrate the `jrebs/easyship-php` library
into [Laravel](https://laravel.com) applications.

* [Installation](#installation)
* [Configuration](#configuration)
* [Usage](#usage)
* [Support](#support)
* [License](#license)


## Installation

Install with [composer](https://getcomposer.org).

```sh
composer require jrebs/easyship-laravel
```

## Configuration

This support package uses a default configuration that will work for most
purposes. The following `.env` variables are supported:

```sh
# Your access token for making calls to the Easyship API
EASYSHIP_API_TOKEN="mytoken"

# The hostname of the Easyship API server (can override for testing)
# Defaults to the official API host https://api.easyship.com
EASYSHIP_API_HOST="http://my-dev-hostname"

# Your secret key for verifying the signature of webhook posts
EASYSHIP_WEBHOOK_SECRET="mysecret"
```

If you want to take control of how configuration is handled, just publish
the configuration file from this package into your application and then you
can do whatever you like with it, including set up default request options
to be passed in to the `GuzzleHttp\Client` instance.

```sh
php artisan vendor:publish --provider=Easyship\\Providers\\EasyshipServiceProvider
```
Once published, season the `config/easyship.php` file to taste.

## Usage

After requiring the package into your application and providing config
keys, you should be able to start working with the API by pulling it out of
the Laravel service container using any of the usual methods or by using the
provided Facade accessor if that is your preference.

```php
// Using the app() helper
// app(\Easyship\EasyshipAPI::class) also works
$api = app('easyship.api');
$categories = $api->categories()->list();

// ...or using the Facade
$categories = Easyship::categories()->list();
```

Similarly, the webhook handler is available preconfigured from the service
container. No facade is provided for this object as it would be of little
value.
```php
$handler = app('easyship.handler');
// Can also use app(\Easyship\Webhooks\Handler::class)
$handler->handle($signature, $payload);
```

## Support

If you find problems with this integration package specifically, please raise
them as issues on this repository. If you find problems with the underlying
`easyship-php` package (more likely), please go to
[that project page](https://github.com/jrebs/easyship-php) for support or to
file an issue report.

## License

This software was written by me, [Justin Rebelo](https://github.com/jrebs),
and is released under the [MIT license](LICENSE.md).
