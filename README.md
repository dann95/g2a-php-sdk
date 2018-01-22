# G2A PAY PHP-SDK
[![Latest Stable Version](https://poser.pugx.org/dann95/g2a-sdk/v/stable)](https://packagist.org/packages/dann95/g2a-sdk)
[![Total Downloads](https://poser.pugx.org/dann95/g2a-sdk/downloads)](https://packagist.org/packages/dann95/g2a-sdk)
[![Latest Unstable Version](https://poser.pugx.org/dann95/g2a-sdk/v/unstable)](https://packagist.org/packages/dann95/g2a-sdk)
[![License](https://poser.pugx.org/dann95/g2a-sdk/license)](https://packagist.org/packages/dann95/g2a-sdk)
[![composer.lock](https://poser.pugx.org/dann95/g2a-sdk/composerlock)](https://packagist.org/packages/dann95/g2a-sdk)

This SDK is an unofficial software with no warranties by G2A PAY ®, you can check more about G2A in: https://www.g2a.com/

## Requirements

- PHP 7.0 and later.
- Guzzle 6
- Doctrine/Collection

## Composer

You can install the sdk via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require dann95/g2a-sdk
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Getting Started

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

## Contribute
Feel free to contribute to this repository.