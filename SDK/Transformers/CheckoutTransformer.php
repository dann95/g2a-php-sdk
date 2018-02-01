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
        $decoded = \GuzzleHttp\json_decode($response->getBody());

        if (200 === $response->getStatusCode() || 201 === $response->getStatusCode()) {
            return Checkout::populate((array) $decoded, $sdk);
        }

        $err = [
            'status'        => 'fail',
            'error_code'    => $decoded->code,
            'error_message' => $decoded->message,
            'error_details' => $decoded->details
        ];
        
        return Checkout::populate($err, $sdk);
    }
}
