<?php

namespace G2A\Environments;

class Endpoints
{
    private $quote;

    private $merchant;

    private $rest;

    public function __construct($env)
    {
        $endpoints = [
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

        if (!array_key_exists($key = strtoupper($env), $endpoints)) {
            throw new \Exception('WRONG env!');
        }
        $this->quote = $endpoints[$key]['quote'];
        $this->merchant = $endpoints[$key]['merchant'];
        $this->rest = $endpoints[$key]['rest'];
    }

    public function quote()
    {
        return $this->quote;
    }

    public function merchant()
    {
        return $this->merchant;
    }

    public function rest()
    {
        return $this->rest;
    }
}
