<?php


namespace G2A\Transformers;

use G2A\Entities\AbstractEntity;
use G2A\Entities\Collections\EntityCollection;
use G2A\Entities\Payments\Payment;
use G2A\Sdk;
use G2A\Transformers\Contract as TransformerContract;
use GuzzleHttp\Psr7\Response;

class PaymentTransformer implements TransformerContract
{
    public function transform(Response $response, Sdk $sdk)
    {
        if($response->getStatusCode() === 200 || $response->getStatusCode() === 201) {
            $decoded = \GuzzleHttp\json_decode($response->getBody());
            return Payment::populate((array) $decoded, $sdk);
        }
        return Payment::populate(['status' => 'fail'], $sdk);
    }
}