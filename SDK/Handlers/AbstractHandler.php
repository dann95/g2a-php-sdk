<?php

namespace G2A\Handlers;

use G2A\Auth\CredentialsBag;
use G2A\Entities\AbstractEntity;
use G2A\Http\Client;
use G2A\Sdk;
use GuzzleHttp\Psr7\Request;
use G2A\Transformers\Contract as TransformerContract;

abstract class AbstractHandler
{
    /**
     * @var Sdk
     */
    protected $sdk;

    /**
     * AbstractHandler constructor.
     * @param Sdk $sdk
     */
    public function __construct(Sdk $sdk)
    {
        $this->sdk = $sdk;
    }

    /**
     * @param Request $request
     * @param TransformerContract $transformer
     * @return AbstractEntity|\G2A\Entities\Collections\EntityCollection
     */
    public function handleApiRequest(Request $request, TransformerContract $transformer)
    {
        try {
            $res = $this->sdk
                ->getHttpClient()
                ->send($request);
            return $transformer->transform($res, $this->sdk);

        }catch (\Exception $exception) {
            var_dump($exception->getResponse()->getBody()->getContents());
            exit();
        }
    }
}