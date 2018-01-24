<?php

namespace G2A\Transformers;

use G2A\Entities\Payments\Checkout;
use G2A\Sdk;
use G2A\Transformers\Contract as TransformerContract;
use GuzzleHttp\Psr7\Response;

class CheckoutTransformer implements TransformerContract
{
    public function transform(Response $response, Sdk $sdk)
    {
        if (200 === $response->getStatusCode() || 201 === $response->getStatusCode()) {
            return Checkout::populate((array) \GuzzleHttp\json_decode($response->getBody()), $sdk);
        }

        return Checkout::populate(['status' => 'fail'], $sdk);
    }
}
