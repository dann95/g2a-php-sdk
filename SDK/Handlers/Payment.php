<?php

namespace G2A\Handlers;

use G2A\Checkout\Cart;
use G2A\Entities\Payments\Checkout;
use GuzzleHttp\Psr7\Request;
use G2A\Handlers\AbstractHandler;
use G2A\Transformers\PaymentTransformer;
use G2A\Transformers\CheckoutTransformer;

class Payment extends AbstractHandler
{
    /**
     * @param $id
     * @return \G2A\Entities\AbstractEntity|\G2A\Entities\Collections\EntityCollection
     */
    public function find($id)
    {
        $request = new Request('get', 'https://api.myjson.com/bins/dth61');
        $transformer = new PaymentTransformer();
        return $this->handleApiRequest($request, $transformer);
    }

    /**
     * @param Cart $cart
     * @return Checkout
     */
    public function create(Cart $cart)
    {
        $sdk = $this->sdk;

        $o = $cart->__toCheckout();
        $o['api_hash'] = $sdk->credentials()->getHash();
        $o['hash'] = $sdk->crypto()->payment($o['order_id'], $o['amount'], $o['currency'], $sdk->credentials()->getSecret());

        $request = new Request('post',
            $this->sdk->endpoints()->quote().'createQuote',
            ['Content-Type' => 'application/x-www-form-urlencoded'],
            http_build_query($o)
        );

        return $this->handleApiRequest($request, (new CheckoutTransformer));
    }

    public function refund(\G2A\Entities\Payments\Payment $payment, $amount = null)
    {

    }
}