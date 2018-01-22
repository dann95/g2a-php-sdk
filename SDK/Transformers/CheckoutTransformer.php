<?php

namespace G2A\Transformers;

use G2A\Entities\AbstractEntity;
use G2A\Entities\Collections\EntityCollection;
use G2A\Sdk;
use G2A\Transformers\Contract as TransformerContract;
use GuzzleHttp\Psr7\Response;

class CheckoutTransformer implements TransformerContract
{
    public function transform(Response $response, Sdk $sdk)
    {
        var_dump($response->getBody()->getContents());
        exit();
    }
}