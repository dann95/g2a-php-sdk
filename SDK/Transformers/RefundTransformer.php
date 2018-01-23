<?php


namespace G2A\Transformers;

use G2A\Entities\AbstractEntity;
use G2A\Sdk;
use G2A\Transformers\Contract;
use GuzzleHttp\Psr7\Response;

class RefundTransformer implements Contract
{
    public function transform(Response $response, Sdk $sdk)
    {
        // TODO: Implement transform() method.
    }
}