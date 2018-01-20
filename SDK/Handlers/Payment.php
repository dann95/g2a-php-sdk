<?php

namespace G2A\Handlers;

use G2A\Checkout\Cart;
use G2A\Handlers\AbstractHandler;
use G2A\Transformers\PaymentTransformer;
use GuzzleHttp\Psr7\Request;

class Payment extends AbstractHandler
{
    /**
     * @param $id
     * @return \G2A\Entities\AbstractEntity|\G2A\Entities\Collections\AbstractEntityCollection
     */
    public function find($id)
    {
        $request = new Request('get', 'https://api.myjson.com/bins/dth61');
        $transformer = new PaymentTransformer();
        return $this->handleApiRequest($request, $transformer);
    }

    public function create(Cart $cart)
    {

    }

    public function refund(\G2A\Entities\Payments\Payment $payment, $amount = null)
    {

    }
}