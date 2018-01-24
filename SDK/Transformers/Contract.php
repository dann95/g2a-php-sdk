<?php

namespace G2A\Transformers;

use G2A\Entities\AbstractEntity;
use G2A\Sdk;
use GuzzleHttp\Psr7\Response;

interface Contract
{
    /**
     * @param Response $response
     *
     * @return AbstractEntity
     */
    public function transform(Response $response, Sdk $sdk);
}
