<?php


namespace G2A\Transformers;

use G2A\Entities\AbstractEntity;
use G2A\Entities\Collections\AbstractEntityCollection;
use G2A\Entities\Payments\Payment;
use G2A\Sdk;
use G2A\Transformers\Contract as TransformerContract;
use GuzzleHttp\Psr7\Response;

class PaymentTransformer implements TransformerContract
{
    public function transform(Response $response, Sdk $sdk)
    {
        $decoded = \GuzzleHttp\json_decode($response->getBody());
        return Payment::populate((array) $decoded, $sdk);
    }
}