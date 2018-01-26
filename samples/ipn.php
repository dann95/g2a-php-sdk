<?php

/**
 * Following steps are to simulate that we received a POST request.
 */
$postSampleFromDocs = <<<'EOL'
type=payment
&transactionId=eac61839-7db6-4cab-8ec3-9708c4676938
&userOrderId=70001010467320
&amount=100.0
&currency=EUR
&status=complete
&orderCreatedAt=2015-02-20 01:21:35
&orderCompleteAt=2015-02-20 01:25:51
&refundedAmount=0
&provisionAmount=0
&hash=f3d3e9bb06697cfd4a8239c39372fd8c5fb687f964eb348887c7f7e5f9aec354
EOL;
parse_str($postSampleFromDocs, $_POST);

/**
 * Now the real code like:.
 */
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

/*
 * checkFromGlobals takes $_POST to get the parameters, but you can also call ->check() giving an array as parameter.
 */
var_dump($sdk->notifications()->checkFromGlobals());

echo '<br>';

/*
 * Its also available as helper, the Crypto class
 */
var_dump(\G2A\Crypto\Crypto::notification($_POST['transactionId'], $_POST['userOrderId'], $_POST['amount'], $apiSecret));
