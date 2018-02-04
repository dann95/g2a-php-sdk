# G2A PAY PHP-SDK
[![Latest Stable Version](https://poser.pugx.org/dann95/g2a-sdk/v/stable)](https://packagist.org/packages/dann95/g2a-sdk)
[![Total Downloads](https://poser.pugx.org/dann95/g2a-sdk/downloads)](https://packagist.org/packages/dann95/g2a-sdk)
[![Latest Unstable Version](https://poser.pugx.org/dann95/g2a-sdk/v/unstable)](https://packagist.org/packages/dann95/g2a-sdk)
[![License](https://poser.pugx.org/dann95/g2a-sdk/license)](https://packagist.org/packages/dann95/g2a-sdk)
[![Build Status](https://travis-ci.org/dann95/g2a-php-sdk.svg?branch=master)](https://travis-ci.org/dann95/g2a-php-sdk)
[![StyleCI](https://styleci.io/repos/118126552/shield?branch=master)](https://styleci.io/repos/118126552)
[![composer.lock](https://poser.pugx.org/dann95/g2a-sdk/composerlock)](https://packagist.org/packages/dann95/g2a-sdk)

This SDK is an unofficial software with no warranties by G2A PAY ®, you can check more about G2A in: https://www.g2a.com/

## Contents

* [Requirements](#requirements)
* [Installation](#composer)
* [Available resources](#available-resources)
* [Getting started](#getting-started)
    * [Checkout sample](samples/checkout.php)
    * [IPN Verify sample](samples/ipn.php)
    * [Subscription sample](samples/subscription.php)
    * [Query payment sample](samples/query-transaction.php)
* [Laravel integration](#laravel-integration-optional-integration)
* [Project goals/todo](#goalstodo)
* [Contribute](#contribute)

## Requirements

- PHP 7.0 and later.
- Guzzle 6

## Composer

You can install the sdk via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require dann95/g2a-sdk
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Available resources
Due some API limitations from G2A, this SDK is restricted to few operations, see the table below to know what this SDK can do.
API means that this is available on this SDK

EMAIL means that is only available by e-mail contact

DASHBOARD means that is only available in merchant dashboard

### Payments

| create  | query  | refund  |
|:-:|:-:|:-:|
| API | API  | EMAIL |

### Subscriptions

| create | cancel  | query  | refund  |  list transactions |
|:-:|:-:|---|---|---|
| API  |  DASHBOARD |  DASHBOARD | EMAIL  | DASHBOARD  |

## Getting Started

### Normal Integration

Setting up credentials be like:

```php
$hash   = '485d733d-7937-414a-8d42-6781397b1c0a';
$mail   = 'merchant@my-test-store.com';
$secret = 'pSO_-N%GZDGfpLu!a5qOUnA>T7QqOro?4?z~Lt5u@LKgg>X247PYvZX8gwy~YY=c';
$env    = 'SANDBOX';
$sdk = new \G2A\Sdk(
    $hash,
    $mail,
    $secret,
    $env
);
 
```

### Laravel integration (optional integration)

Insert the provider into providers array in config/app.php

```php
'providers' => [
    // previous providers
     \G2A\Integrations\Laravel\G2aServiceProvider::class,   
    // next providers
]
```

Then run the following command:
```bash
php artisan vendor:publish --tag=g2a
```

Edit the file configs/g2a.php, you will have something like this

**prefer use env() helper instead of strings to save your credentials**

```php
<?php
/**
 * to obtain hash and secret, go to:
 * https://www.test.pay.g2a.com/setting/merchant (in case of SANDBOX)
 * https://www.pay.g2a.com/setting/merchant (in case of PRODUCTION)
 * email is your account e-mail.
 */
return [
    'hash' => '',
    'secret' => '',
    'email' => '',
    'environment' => 'SANDBOX', // SANDBOX || PRODUCTION
];
```

Now when you do, it will give you a fresh instance of SDK using settings on config/g2a.php:
```php

$sdk = app('G2A');

```

Or, when inside a Controller/any part of Laravel where Auto Dependency Injection is available:
```php
class FooBarController extends Controller
{
    public function checkout(\G2A\Sdk $sdk)
    {
        dd($sdk);
    }
}
```

## Goals/Todo

- [ ] 100% Unit coverage
- [ ] Use abstraction of HttpClient instead of Guzzle
- [ ] Do a Legacy version, for php 5.4+
- [ ] Full error detailed Exceptions and Entities
- [ ] Release first stable version (1.0.0)

## Contribute
Feel free to contribute to this repository.
