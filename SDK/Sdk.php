<?php

namespace G2A;

use G2A\Auth\CredentialsBag;
use G2A\Crypto\Crypto;
use G2A\Handlers\Notification;
use G2A\Handlers\Payment;
use G2A\Handlers\Subscription;
use G2A\Http\Client;

class Sdk
{
    /**
     * @var CredentialsBag
     */
    private $credentials;
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var Crypto
     */
    private $crypto;

    /**
     * Sdk constructor.
     * @param $apiHash
     * @param $merchantEmail
     * @param $apiSecret
     * @param string $env
     */
    public function __construct($apiHash, $merchantEmail, $apiSecret, $env = 'PRODUCTION')
    {
        $this->credentials = new CredentialsBag($apiHash, $merchantEmail, $apiSecret);
        $this->crypto = new Crypto();
        $this->httpClient = new Client(['defaults' => [
            'headers' => [
                'Authorization' => "{$apiHash};".Crypto::authorizationHeader($apiHash, $merchantEmail, $apiSecret)
            ]
        ]]);
    }

    /**
     * @return Payment
     */
    public function payments()
    {
        return (new Payment($this));
    }

    /**
     * @return Subscription
     */
    public function subscriptions()
    {
        return (new Subscription($this));
    }

    /**
     * @return Notification
     */
    public function notifications()
    {
        return (new Notification($this));
    }

    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @return Crypto
     */
    public function crypto()
    {
        return $this->crypto;
    }

    /**
     * @return CredentialsBag
     */
    public function credentials()
    {
        return $this->credentials;
    }
}