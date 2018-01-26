<?php

namespace G2A\Handlers;

use G2A\Checkout\Cart;
use G2A\Transformers\CheckoutTransformer;
use GuzzleHttp\Psr7\Request;

class Subscription extends AbstractHandler
{
    /**
     * @param Cart $cart
     *
     * @return \G2A\Entities\Payments\Checkout
     */
    public function create(Cart $cart)
    {
        $sdk = $this->sdk;

        $o = $cart->__toRecurringCheckout();
        $o['api_hash'] = $sdk->credentials()->getHash();
        $o['hash'] = $sdk->crypto()->payment($o['order_id'], $o['amount'], $o['currency'], $sdk->credentials()->getSecret());

        $request = new Request('post',
            $this->sdk->endpoints()->quote().'createQuote',
            ['Content-Type' => 'application/x-www-form-urlencoded'],
            http_build_query($o)
        );

        return $this->handleApiRequest($request, (new CheckoutTransformer()));
    }
}
