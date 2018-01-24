<?php

namespace G2A\Auth;

class CredentialsBag
{
    /**
     * @var string
     */
    private $hash;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var string
     */
    private $secr;

    /**
     * CredentialsBag constructor.
     *
     * @param $apiHash
     * @param $merchantEmail
     * @param $apiSecret
     */
    public function __construct($apiHash, $merchantEmail, $apiSecret)
    {
        $this->hash = $apiHash;
        $this->mail = $merchantEmail;
        $this->secr = $apiSecret;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->mail;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secr;
    }
}
