<?php

use PHPUnit\Framework\TestCase;

class CredentialsBagTest extends TestCase
{

    protected $credentials;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->credentials = [
            'hash'      => "e10adc3949ba59abbe56e057f20f883e",
            'secret'    => 'secretphrase',
            'email'     => 'xd@example.com'
        ];
        parent::__construct($name, $data, $dataName);
    }

    public function testHash()
    {
        $bag = new \G2A\Auth\CredentialsBag(
            $this->credentials['hash'],
            $this->credentials['email'],
            $this->credentials['secret']
        );

        $this->assertEquals($this->credentials['hash'], $bag->getHash());

        return $bag;
    }

    /**
     * @depends testHash
     */
    public function testEmail(\G2A\Auth\CredentialsBag $bag)
    {
        $this->assertEquals($this->credentials['email'], $bag->getEmail());
        return $bag;
    }

    /**
     * @depends testEmail
     */
    public function testSecret(\G2A\Auth\CredentialsBag $bag)
    {
        $this->assertEquals($this->credentials['secret'], $bag->getSecret());
    }
}