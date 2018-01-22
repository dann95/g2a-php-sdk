## My stack:
- OS and version: (ex: windows 7/ Ubuntu 14.04 / OSx 10 Cheetah)
- PHP version: (ex: PHP 7.0.21-1)
- CURL version: (ex: curl 7.35.0)

## Steps to reproduce:
```php
<?php
require_once '../vendor/autoload.php';
$sdk = new \G2A\Sdk(
    $hash,
    $mail,
    $secret,
    'SANDBOX'
);

$sdk->foo()->bar();
```

## Expected result:
> Here a little explanation about the expected result

## Real result:
> Here a little explanation about what is really happening

## Possible Solution:
> This is optional, but if u have a suggest for fix it, do it.

## Screenshots:
> This is optional, but if helps, insert some screenshots