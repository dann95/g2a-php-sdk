<?php

use PHPUnit\Framework\TestCase;
use G2A\Crypto\Crypto;

class CryptoTest extends TestCase
{
    /**
     * @return Crypto
     */
    public function testPayment()
    {
        $crypto = new Crypto();
        $userOrderId = 1;
        $amount = 2;
        $currency = 3;
        $ApiSecret = 4;
        $this->assertEquals('76f265387969426f70360550b5796359c63c37c6b21f31bdfa87c4a0bb78b4ff', $crypto->payment($userOrderId, $amount, $currency, $ApiSecret));
        return $crypto;
    }

    /**
     * @depends testPayment
     * @param Crypto $crypto
     * @return Crypto
     */
    public function testAuthorizationHeader(Crypto $crypto)
    {
        $apiHash = 1;
        $merchantEmail = 2;
        $apiSecret = 3;
        $this->assertEquals('a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', $crypto->authorizationHeader($apiHash, $merchantEmail, $apiSecret));
        return $crypto;
    }

    /**
     * @depends testAuthorizationHeader
     * @param Crypto $crypto
     * @return Crypto
     */
    public function testNotification(Crypto $crypto)
    {
        $transactionId = 1;
        $userOrderId = 2;
        $amount = 3;
        $apiSecret = 4;
        $this->assertEquals('be536db72f8f5634b9319115ec49aaff7b5e07c23dd2746c11c66be836a954dd', $crypto->notification($transactionId, $userOrderId, $amount, $apiSecret));
        return $crypto;
    }


    /**
     * @depends testNotification
     * @param Crypto $crypto
     */
    public function testRefund(Crypto $crypto)
    {
        $transactionId = 1;
        $userOrderId = 2;
        $amount = 3;
        $refundedAmount = 4;
        $ApiSecret = 5;
        $this->assertEquals('ddd56f74cb50a6a1df36f3d9c30aaa1c36621be77c57824f8a4a9709a9b67783', $crypto->refund($transactionId,$userOrderId,$amount,$refundedAmount, $ApiSecret));
    }


}