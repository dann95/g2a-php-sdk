<?php

require_once '../vendor/autoload.php';

$apiHash = 'cac3f440-7cc0-4c8b-8482-dbf8f1fe4d45';
$apiSecret = 'NaLDGGS5KBxsq&qewSC@uLSIidKlrxb2LwFb0hfLsR1WPr&97A2_UU7?$RlmCAnW';
$merchantEmail = 'daniel@nptunnel.com';
$env = 'SANDBOX';

$sdk = new \G2A\Sdk(
    $apiHash,
    $merchantEmail,
    $apiSecret,
    $env
);

$iphone = new \G2A\Checkout\Item(1000, 'Iphone SE 64gb', 1300, 1, 200, 'http://mysite.com/iphone-se');
$galaxy = new \G2A\Checkout\Item(500, 'Samsung Galaxy Note8', 2000, 1, 201, 'http://mysite.com/galaxy-note-8');

$cart = new \G2A\Checkout\Cart(6063, 'http://mysite.com/checkout-thanks', 'http://mysite.com/checkout-fail', 'USD');

$cart->add($iphone);
$cart->add($galaxy);

$checkout = $sdk->payments()->create($cart);

var_dump($checkout);
