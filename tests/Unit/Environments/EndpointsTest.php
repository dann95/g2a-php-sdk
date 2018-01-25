<?php

use PHPUnit\Framework\TestCase;
use G2A\Environments\Endpoints;
use G2A\Exceptions\WrongEnvironment;

class EndpointsTest extends TestCase
{
    public function testWrongEnvironment()
    {
        $this->expectException(WrongEnvironment::class);
        $endpoints = new Endpoints("STAGING");
    }

    public function testEndpoints()
    {
        $real = [
            'PRODUCTION' => [
                'quote' => 'https://checkout.pay.g2a.com/index/',
                'merchant' => 'https://pay.g2a.com/',
                'rest' => 'https://pay.g2a.com/rest/',
            ],
            'SANDBOX' => [
                'quote' => 'https://checkout.test.pay.g2a.com/index/',
                'merchant' => 'https://www.test.pay.g2a.com/',
                'rest' => 'https://www.test.pay.g2a.com/rest/',
            ],
        ];

        $sandboxInstance = new Endpoints('SANDBOX');
        $productionInstance = new Endpoints('PRODUCTION');

        $generated = [
            'PRODUCTION' => [
                'quote' => $productionInstance->quote(),
                'merchant' => $productionInstance->merchant(),
                'rest' => $productionInstance->rest(),
            ],
            'SANDBOX' => [
                'quote' => $sandboxInstance->quote(),
                'merchant' => $sandboxInstance->merchant(),
                'rest' => $sandboxInstance->rest(),
            ],
        ];

        $this->assertEquals($real, $generated);
    }
}