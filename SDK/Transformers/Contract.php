<?php


namespace G2A\Transformers;

use G2A\Entities\AbstractEntity;
use G2A\Entities\Collections\EntityCollection;
use G2A\Sdk;
use GuzzleHttp\Psr7\Response;

interface Contract
{
    /**
     * @param Response $response
     * @return AbstractEntity | EntityCollection
     */
    public function transform(Response $response, Sdk $sdk);
}