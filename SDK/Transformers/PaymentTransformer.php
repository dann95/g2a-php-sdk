<?php

namespace G2A\Transformers;

use G2A\Entities\AbstractEntity;
use G2A\Entities\Collections\EntityCollection;
use G2A\Entities\Payments\Payment;
use G2A\Exceptions\G2aException;
use G2A\Exceptions\ResourceNotFoundException;
use G2A\Sdk;
use G2A\Transformers\Contract as TransformerContract;
use GuzzleHttp\Psr7\Response;

class PaymentTransformer implements TransformerContract
{
    /**
     * @var array
     */
    private $meta;

    /**
     * PaymentTransformer constructor.
     *
     * @param array $meta
     */
    public function __construct(array $meta = [])
    {
        $this->meta = $meta;
    }

    /**
     * @param Response $response
     * @param Sdk      $sdk
     *
     * @return AbstractEntity|EntityCollection|static
     *
     * @throws G2aException
     * @throws ResourceNotFoundException
     */
    public function transform(Response $response, Sdk $sdk)
    {
        switch ($response->getStatusCode()) {
            case 200:
                return Payment::populate((array) \GuzzleHttp\json_decode($response->getBody()), $sdk);

                break;
            case 404:
                throw new ResourceNotFoundException("Payment with id `{$this->meta['id']}` was not found");
                break;
            default:
                throw new G2aException('Request could not be processed');
                break;
        }
    }
}
