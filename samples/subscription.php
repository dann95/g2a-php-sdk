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

$recurring = new \G2A\Checkout\RecurringPayment('vip signature', \G2A\Checkout\RecurringPayment::MONTHLY, \G2A\Checkout\RecurringPayment::TYPE_PRODUCT);

$vip = new \G2A\Checkout\Item(1000, 'Vip 30 days', 19.99, 1, 1, 'http://mysite.com/vip');

$cart = new \G2A\Checkout\Cart(6063, 'http://mysite.com/checkout-thanks', 'http://mysite.com/checkout-fail', 'USD', $recurring);

$cart->add($vip);

$checkout = $sdk->subscriptions()->create($cart);

var_dump($checkout);
